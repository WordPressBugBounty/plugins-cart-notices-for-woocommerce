import React, { useEffect, useMemo, useState } from 'react';

const { ModuleContainer, StyleContainer, elementClassnames } = window?.divi?.module || {};

const ModuleStyles = ({ elements, settings, mode, state, noStyleTag }) => (
  <StyleContainer mode={mode} state={state} noStyleTag={noStyleTag}>
    {elements.style({
      attrName: 'module',
      styleProps: { disabledOn: { disabledModuleVisibility: settings?.disabledModuleVisibility } },
    })}
    {elements.style({ attrName: 'notice' })}
  </StyleContainer>
);

const ModuleScriptData = ({ elements }) => (
  <React.Fragment>{elements.scriptData({ attrName: 'module' })}</React.Fragment>
);

const moduleClassnames = ({ classnamesInstance, attrs }) => {
  classnamesInstance.add(elementClassnames({ attrs: attrs?.module?.decoration ?? {} }));
};

const getPreviewConfig = () => {
  if (window?.BRCNDivi5Preview) {
    return window.BRCNDivi5Preview;
  }

  const scriptSrc = document?.currentScript?.src;
  if (!scriptSrc) {
    return {};
  }

  const params = new URL(scriptSrc).searchParams;
  return {
    ajaxUrl: decodeURIComponent(params.get('brcn_ajax_url') || ''),
    action: params.get('brcn_action') || '',
    nonce: params.get('brcn_nonce') || '',
  };
};

const previewConfig = getPreviewConfig();

const Placeholder = ({ children }) => (
  <div style={{
    padding: '2em 0',
    background: '#6c2eb9',
    color: '#fff',
    fontSize: '12px',
    fontWeight: '600',
    textAlign: 'center',
    borderRadius: '1em',
  }}>
    <h3 style={{ color: '#000', fontWeight: '900' }}>BeRocket Cart Notice</h3>
    {children}
  </div>
);

const CartNoticePreview = ({ attrs }) => {
  const [state, setState] = useState({ html: '', isLoading: true, error: '' });
  const attrsKey = useMemo(() => JSON.stringify(attrs ?? {}), [attrs]);

  useEffect(() => {
    if (!previewConfig.ajaxUrl || !previewConfig.action || !previewConfig.nonce) {
      setState({ html: '', isLoading: false, error: 'Cart Notice not displayed in Builder' });
      return undefined;
    }

    const controller = new AbortController();
    const body = new FormData();
    body.append('action', previewConfig.action);
    body.append('nonce', previewConfig.nonce);
    setState((current) => ({ ...current, isLoading: true, error: '' }));

    fetch(previewConfig.ajaxUrl, {
      body,
      method: 'POST',
      credentials: 'same-origin',
      signal: controller.signal,
    })
      .then((response) => response.json())
      .then((response) => {
        if (!response?.success) {
          throw new Error(response?.data?.message || 'Cart Notice not displayed in Builder');
        }
        setState({ html: response?.data?.html || '', isLoading: false, error: '' });
      })
      .catch((error) => {
        if (error.name !== 'AbortError') {
          setState({ html: '', isLoading: false, error: error.message || 'Cart Notice not displayed in Builder' });
        }
      });

    return () => controller.abort();
  }, [attrsKey]);

  if (state.isLoading) {
    return <div className="et-fb-loader-wrapper"><div className="et-fb-loader" /></div>;
  }
  if (state.error || !state.html) {
    return <Placeholder>{state.error || 'Cart Notice not displayed in Builder'}</Placeholder>;
  }
  return <div dangerouslySetInnerHTML={{ __html: state.html }} />;
};

export const createCartNoticeModule = (metadata) => ({
  metadata,
  renderers: {
    edit: ({ attrs, id, name, elements }) => (
      <ModuleContainer
        attrs={attrs}
        elements={elements}
        id={id}
        moduleClassName={metadata.moduleClassName}
        name={name}
        scriptDataComponent={ModuleScriptData}
        stylesComponent={ModuleStyles}
        classnamesFunction={moduleClassnames}
      >
        {elements.styleComponents({ attrName: 'module' })}
        {elements.styleComponents({ attrName: 'notice' })}
        <div className="et_pb_module_inner"><CartNoticePreview attrs={attrs} /></div>
      </ModuleContainer>
    ),
  },
  placeholderContent: {
    module: { meta: { adminLabel: { desktop: { value: metadata.title } } } },
    ...metadata.defaultAttrs,
  },
});
