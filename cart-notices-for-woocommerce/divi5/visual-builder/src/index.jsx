import { addAction } from '@wordpress/hooks';
import { registerModule } from '@divi/module-library';
import { createCartNoticeModule } from './module-factory';
import cartNoticeMetadata from './modules/cart-notice/module.json';

addAction('divi.moduleLibrary.registerModuleLibraryStore.after', 'brcn.divi5Module', () => {
  const module = createCartNoticeModule(cartNoticeMetadata);
  const { metadata, ...moduleConfig } = module;
  registerModule(metadata, moduleConfig);
});
