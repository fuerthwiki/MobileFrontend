<?php
/**
 * Definition of MobileFrontend's ResourceLoader modules.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

/**
 * A boilerplate containing common properties for all RL modules served to mobile site
 */
$wgMFMobileResourceBoilerplate = array(
	'raw' => true,
	'localBasePath' => $localBasePath,
	'remoteExtPath' => $remoteExtPath,
	'targets' => array( 'mobile', 'desktop' ),
);

/**
 * A boilerplate for the MFResourceLoaderModule that supports templates
 */
$wgMFMobileResourceTemplateBoilerplate = array(
	'localBasePath' => $localBasePath,
	'localTemplateBasePath' => $localBasePath . '/templates',
	'class' => 'MFResourceLoaderModule',
);

/**
 * A boilerplate containing common properties for all RL modules served to mobile site special pages
 */
$wgMFMobileSpecialPageResourceBoilerplate = array(
	'localBasePath' => $localBasePath,
	'remoteExtPath' => $remoteExtPath,
	'targets' => 'mobile',
	'group' => 'other',
);

/**
 * A boilerplate for RL script modules
*/
$wgMFMobileSpecialPageResourceScriptBoilerplate = $wgMFMobileSpecialPageResourceBoilerplate + array(
	'dependencies' => array( 'mobile.stable' ),
);
/**
 * A boilerplate for RL style modules for special pages
*/
$wgMFMobileSpecialPageResourceStyleBoilerplate = $wgMFMobileSpecialPageResourceBoilerplate + array(
	// ensure special css is always loaded after mobile.styles for cascading purposes (keep jgonera happy)
	'dependencies' => array( 'mobile.styles' ),
);

$wgResourceModules = array_merge( $wgResourceModules, array(
	// main page
	'mobile.mainpage.styles' => $wgMFMobileResourceBoilerplate + array(
		'dependencies' => array( 'mobile.startup' ),
		'styles' => array(
			'stylesheets/mainpage/mainpage.css',
		),
		'group' => 'other',
	),

	'mobile.mainpage.plumbing' => array(
		'messages' => array(
			// mf-homepage.js
			'mobile-frontend-empty-homepage-text' => array( 'parse' ),
		),
		'class' => 'MFResourceLoaderModule',
		'group' => 'other',
	),

	'mobile.mainpage.scripts' => $wgMFMobileResourceBoilerplate + array(
		'dependencies' => array(
			'mobile.startup',
			'mobile.mainpage.plumbing',
		),
		'scripts' => array(
			'javascripts/modules/mf-homepage.js',
		),
		'group' => 'other',
	),

	// Filepages
	'mobile.file.styles' => $wgMFMobileResourceBoilerplate + array(
		'dependencies' => array( 'mobile.startup' ),
		'styles' => array(
			'stylesheets/file/filepage.css',
		),
	),

	'mobile.file.scripts' => $wgMFMobileResourceBoilerplate + array(
		'dependencies' => array( 'mobile.startup' ),
		'scripts' => array(
			'javascripts/file/filepage.js'
		),
	),

	'mobile.styles.page' => $wgMFMobileResourceBoilerplate + array(
		'dependencies' => array( 'mobile.startup' ),
		'styles' => array(
			'stylesheets/common/mf-enwp.css'
		),
	),

	'mobile.styles' => $wgMFMobileResourceBoilerplate + array(
		'styles' => array(
			'stylesheets/externals/reset.css',
			'stylesheets/common/mf-common.css',
			'stylesheets/common/ui.css',
			'stylesheets/common/mf-typography.css',
			'stylesheets/common/mf-footer.css',
			'stylesheets/modules/mf-toggle.css',
			// FIXME: move to module mobile.stable.styles for some reason it breaks RTL when in that module
			'stylesheets/common/mf-navigation.css',
			'stylesheets/common/overlays.css',
			'stylesheets/common/drawer.css',
			'stylesheets/common/mf-hacks.css',
		),
		'position' => 'top',
	),

	'mobile.styles.beta' => $wgMFMobileResourceBoilerplate + array(
		'styles' => array(
			'stylesheets/common/pageactions.css',
			'stylesheets/common/user.css',
		),
		'position' => 'top',
	),

	// Important: This module is loaded on both mobile and desktop skin
	'mobile.head' => $wgMFMobileResourceBoilerplate + array(
		'scripts' => array(
			'javascripts/common/polyfills.js',
			'javascripts/common/modules.js',
		),
		'position' => 'top',
	),

	'mobile.startup' => $wgMFMobileResourceBoilerplate + array(
		'dependencies' => array(
			'mobile.head',
		),
		'scripts' => array(
			'javascripts/externals/hogan.js',
			'javascripts/common/Class.js',
			'javascripts/common/eventemitter.js',
			'javascripts/common/Router.js',
			'javascripts/common/mf-application.js',
			'javascripts/common/history.js',
			'javascripts/common/mf-settings.js',
			'javascripts/modules/mf-stop-mobile-redirect.js',
		),
		'position' => 'bottom',
	),

	'mobile.stable.plumbing' => array(
		'messages' => array(
			// NagOverlay.js
			'mobile-frontend-photo-license' => array( 'parse' ),
			'mobile-frontend-photo-nag-1-bullet-1-heading',
			'mobile-frontend-photo-nag-1-bullet-1-text' => array( 'parse' ),
			'mobile-frontend-photo-nag-1-bullet-2-heading',
			'mobile-frontend-photo-nag-1-bullet-2-text',
			'mobile-frontend-photo-nag-2-bullet-1-heading',
			'mobile-frontend-photo-nag-3-bullet-1-heading',
			'parentheses',
			'mobile-frontend-learn-more',
			'mobile-frontend-photo-nag-learn-more-heading',
			'mobile-frontend-photo-nag-learn-more-1' => array( 'parse' ),
			'mobile-frontend-photo-nag-learn-more-2' => array( 'parse' ),
			'mobile-frontend-photo-nag-learn-more-3' => array( 'parse' ),
		),
		'localBasePath' => $localBasePath,
		'localTemplateBasePath' => $localBasePath . '/templates',
		'templates' => array(
			'wikitext/commons-upload',
			// LanguageOverlay.js
			'overlays/languages',
			// leadphoto.js
			'leadPhoto',
			'overlay',
			'overlays/cleanup',
			'overlays/learnMore',
			// search-2.js
			'articleList',
			'overlays/search/search',
			// PhotoUploader.js
			// For new page action menu
			'photoUploadAction',
			'photoUploader',
			// PhotoUploaderPreview.js
			'photoUploadPreview',
			// NagOverlay.js
			'photoNag',
			'ctaDrawer',
		),
		'class' => 'MFResourceLoaderModule',
	),

	'mobile.beta.plumbing' => array(
		'localBasePath' => $localBasePath,
		'localTemplateBasePath' => $localBasePath . '/templates',
		'templates' => array(
			'overlays/editor',
			'section',
			// talk.js
			'overlays/talk',
			'overlays/talkSectionAdd',
			'talkSection',
			// page.js
			'page',
			'languageSection',
		),
		'messages' => array(
			// editor.js
			'mobile-frontend-editor-cta',
			'mobile-frontend-editor-edit',
			// modules/editor/EditorOverlay.js
			'mobile-frontend-editor-continue',
			'mobile-frontend-editor-save',
			'mobile-frontend-editor-cancel',
			'mobile-frontend-editor-keep-editing',
			'mobile-frontend-editor-license' => array( 'parse' ),
			'mobile-frontend-editor-summary-placeholder',
			'mobile-frontend-editor-cancel-confirm',
			'mobile-frontend-editor-wait',
			'mobile-frontend-editor-success',
			'mobile-frontend-editor-refresh',
			'mobile-frontend-editor-error',
			'mobile-frontend-editor-error-conflict',
			'mobile-frontend-editor-error-loading',
			// modules/editor/PreviewOverlay.js
			'mobile-frontend-editor-error-preview',
			'mobile-frontend-editor-preview-explanation',
			// page.js
			'mobile-frontend-talk-overlay-header',
			// history-beta.js
			'mobile-frontend-language-article-heading',
		),
		'class' => 'MFResourceLoaderModule',
	),

	'mobile.beta.common' => $wgMFMobileResourceBoilerplate + array(
		'dependencies' => array(
			'mobile.beta.plumbing',
			'mobile.stable.common',
		),
		'scripts' => array(
			'javascripts/common/application-beta.js',
			'javascripts/common/history-beta.js',
			'javascripts/views/page.js',
		),
		'messages' => array(
			// page.js and talk.js (alpha)
			'mobile-frontend-talk-overlay-header',
			// LanguageOverlay.js
			'mobile-frontend-language-header',
			'mobile-frontend-language-site-choose',
			'mobile-frontend-language-footer',
		),
	),

	'mobile.beta' => $wgMFMobileResourceBoilerplate + array(
		'dependencies' => array(
			'mobile.stable',
			'mobile.beta.common',
		),
		'styles' => array(
			'stylesheets/modules/editor.css',
			'stylesheets/modules/talk.css',
		),
		'scripts' => array(
			'javascripts/modules/editor/EditorApi.js',
			'javascripts/modules/editor/EditorOverlay.js',
			'javascripts/modules/editor/editor.js',
			'javascripts/modules/mf-toggle-dynamic.js',
			'javascripts/modules/talk/TalkSectionOverlay.js',
			'javascripts/modules/talk.js',
			'javascripts/common/user.js',
			'javascripts/modules/search-pageimages.js',
			'javascripts/modules/languages-preferred.js',
		),
		'position' => 'bottom',
		'messages' => array(
			'pagetitle',

			// for mf-toggle-dynamic.js
			'mobile-frontend-show-button',
			'mobile-frontend-hide-button',

			// for talk.js
			'mobile-frontend-talk-explained',
			'mobile-frontend-talk-explained-empty',
			'mobile-frontend-talk-overlay-lead-header',
			'mobile-frontend-talk-overlay-header',
			'mobile-frontend-talk-add-overlay-subject-placeholder',
			'mobile-frontend-talk-add-overlay-content-placeholder',
			'mobile-frontend-talk-edit-summary',
			'mobile-frontend-talk-add-overlay-submit',
			'mobile-frontend-talk-reply-success',
			'mobile-frontend-talk-reply',
			'mobile-frontend-talk-reply-info',

			// user.js
			'mobile-frontend-user-cta',
		),
	),

	'mobile.action.history' => $wgMFMobileResourceBoilerplate + array(
		'dependencies' => array( 'mobile.startup' ),
		'styles' => array(
		),
		'scripts' => array(
			'stylesheets/actions/mf-history.css',
		),
		'group' => 'other',
	),

	'mobile.history' => $wgMFMobileResourceBoilerplate + array(
		'scripts' => array(
			'javascripts/externals/history.js',
			'javascripts/externals/history.adapter.jquery.js',
		),
	),

	'mobile.alpha.plumbing' => $wgMFMobileResourceTemplateBoilerplate + array(
		'templates' => array(
			'overlays/nearby',
		),
	),
	'mobile.alpha' => $wgMFMobileResourceBoilerplate + array(
		'dependencies' => array(
			'mobile.stable',
			'mobile.beta',
			'mobile.history',
			'mobile.alpha.plumbing',
			'mobile.nearby',
		),
		'messages' => array(

			// for mf-table.js
			'mobile-frontend-table',

			// history-alpha.js
			'mobile-frontend-language-article-heading',

			// nearbypages.js
			'mobile-frontend-nearby-to-page',
		),
		'styles' => array(
			'stylesheets/modules/mf-tables.css',
			'stylesheets/modules/nearbypages.css',
		),
		'scripts' => array(
			'javascripts/modules/mf-inline-style-scrubber.js',
			'javascripts/common/history-alpha.js',
			'javascripts/modules/mf-tables.js',
			'javascripts/modules/mf-translator.js',
			'javascripts/modules/lazyload.js',
			'javascripts/modules/nearbypages.js'
		),
	),

	'mobile.toast.styles' => $wgMFMobileResourceBoilerplate + array(
		'styles' => array(
			'stylesheets/common/notifications.css',
		),
		'position' => 'top',
	),

	'mobile.stable.styles' => $wgMFMobileResourceBoilerplate + array(
		'dependencies' => array(
			'mobile.pagelist.styles',
		),
		'styles' => array(
			'stylesheets/common/common-js.css',
			'stylesheets/modules/languages.css',
			'stylesheets/modules/mf-search.css',
			'stylesheets/modules/mf-references.css',
			'stylesheets/modules/mf-cleanuptemplates.css',
			'stylesheets/modules/mf-watchstar.css',
			'stylesheets/modules/mf-photo.css',
		),
		'position' => 'top',
	),

	// Important: This module is loaded on both mobile and desktop skin
	'mobile.stable.common' => $wgMFMobileResourceBoilerplate + array(
		'dependencies' => array(
			'mobile.startup',
			'mobile.stable.plumbing',
			'mobile.toast.styles',
			'mediawiki.jqueryMsg',
		),
		'scripts' => array(
			'javascripts/common/mf-api.js',
			'javascripts/common/mf-view.js',
			'javascripts/common/Drawer.js',
			'javascripts/common/CtaDrawer.js',
			'javascripts/common/Overlay.js',
			'javascripts/widgets/progress-bar.js',
			'javascripts/common/mf-navigation.js',
			'javascripts/common/mf-notification.js',
			// Upload specific code
			'javascripts/common/uploads/LearnMoreOverlay.js',
			'javascripts/common/uploads/PhotoApi.js',
			'javascripts/common/uploads/NagOverlay.js',
			'javascripts/common/uploads/PhotoUploadProgress.js',
			'javascripts/common/uploads/PhotoUploaderPreview.js',
			'javascripts/common/uploads/PhotoUploader.js',
			'javascripts/common/uploads/LeadPhoto.js',
			// Language specific code
			'javascripts/common/languages/LanguageOverlay.js',
		),
		'messages' => array(
			// mf-notification.js
			'mobile-frontend-logged-in-toast-notification',

			// mf-navigation.js
			'mobile-frontend-watchlist-cta-button-signup',
			'mobile-frontend-watchlist-cta-button-login',
			'mobile-frontend-drawer-cancel',
			'mobile-frontend-overlay-escape',

			// LearnMoreOverlay.js
			'mobile-frontend-photo-ownership-confirm',

			// PhotoApi.js
			'mobile-frontend-photo-article-edit-comment',
			'mobile-frontend-photo-article-donate-comment',
			'mobile-frontend-photo-upload-error-filename',
			'mobile-frontend-photo-upload-comment',

			// PhotoUploader.js
			'mobile-frontend-photo-upload-error',
			'mobile-frontend-photo-upload-cta',

			// PhotoUploaderPreview.js
			'mobile-frontend-photo-ownership',
			'mobile-frontend-photo-ownership-help',
			'mobile-frontend-photo-caption-placeholder',
			'mobile-frontend-image-loading',
			'mobile-frontend-photo-submit',
			'mobile-frontend-photo-cancel',
			'mobile-frontend-photo-ownership-bullet-one',
			'mobile-frontend-photo-ownership-bullet-two',
			'mobile-frontend-photo-ownership-bullet-three',
			'mobile-frontend-photo-upload-error-file-type',

			// PhotoUploadProgress.js
			'mobile-frontend-image-uploading-wait',
			'mobile-frontend-image-uploading-long',
			'mobile-frontend-image-uploading-cancel',

			// LanguageOverlay.js
			'mobile-frontend-language-header',
			'mobile-frontend-language-site-choose',
			'mobile-frontend-language-footer',
		),
	),

	'mobile.pagelist.styles' => $wgMFMobileResourceBoilerplate + array(
		'styles' => array(
			'stylesheets/common/pagelist.css',
		),
	),

	'mobile.stable' => $wgMFMobileResourceBoilerplate + array(
		'dependencies' => array(
			'mobile.startup',
			'mobile.stable.common',
			'mediawiki.util',
			'mobile.stable.styles',
		),
		'scripts' => array(
			'javascripts/modules/mf-toggle.js',
			'javascripts/modules/mf-cleanuptemplates.js',
			'javascripts/modules/languages.js',
			'javascripts/modules/mf-last-modified.js',
			'javascripts/modules/leadphoto.js',
			'javascripts/modules/mainmenutweaks.js',
			'javascripts/modules/search-2.js',
			'javascripts/modules/mf-watchstar.js',
			'javascripts/modules/mf-references.js'
		),
		'messages' => array(
			// for mf-toggle.js
			'mobile-frontend-close-section',
			'mobile-frontend-show-button',
			'mobile-frontend-hide-button',

			// mf-cleanuptemplates.js
			'mobile-frontend-meta-data-issues',
			'mobile-frontend-meta-data-issues-header',

			// mf-last-modified.js
			'mobile-frontend-last-modified-seconds',
			'mobile-frontend-last-modified-hours',
			'mobile-frontend-last-modified-minutes',
			'mobile-frontend-last-modified-hours',
			'mobile-frontend-last-modified-days',
			'mobile-frontend-last-modified-months',
			'mobile-frontend-last-modified-years',

			// leadphoto.js
			'mobile-frontend-photo-upload-success-article',
			'mobile-frontend-photo-upload',

			// mf-watchstar.js
			'mobile-frontend-watchlist-add',
			'mobile-frontend-watchlist-removed',
			'mobile-frontend-watchlist-cta',

			// for search.js
			'mobile-frontend-search-help',
			'mobile-frontend-search-noresults',
		),
	),

	'mobile.site' => array(
		'dependencies' => array( 'mobile.startup' ),
		'class' => 'MobileSiteModule',
	),

	// Resources to be loaded on desktop version of site
	'mobile.desktop' => array(
		'scripts' => array( 'javascripts/desktop/unset_stopmobileredirect.js' ),
		'dependencies' => array( 'jquery.cookie' ),
		'localBasePath' => $localBasePath,
		'remoteExtPath' => $remoteExtPath,
		'targets' => 'desktop',
	),

	/**
		* Special page modules
		*
		* Note: Use correct names to ensure modules load on pages
		* Name must be the name of the special page lowercased prefixed by 'mobile.'
		* suffixed by '.styles' or '.scripts'
		*/
	'mobile.mobilemenu.styles' => $wgMFMobileSpecialPageResourceStyleBoilerplate + array(
		'styles' => array(
			'stylesheets/specials/mobilemenu.css',
		),
	),
	'mobile.mobileoptions.styles' => $wgMFMobileSpecialPageResourceBoilerplate + array(
		'styles' => array(
			'stylesheets/specials/mobileoptions.css',
		),
	),
	'mobile.mobileoptions.scripts' => $wgMFMobileSpecialPageResourceBoilerplate + array(
		'position' => 'top',
		'scripts' => array(
			'javascripts/specials/mobileoptions.js',
		),
	),

	'mobile.nearby.plumbing' => $wgMFMobileResourceTemplateBoilerplate + array(
		'templates' => array(
			'articleList',
			'overlays/pagePreview',
			'overlays/loading',
		),
	),

	'mobile.nearby.previews' => $wgMFMobileResourceBoilerplate + array(
		'dependencies' => array(
			'mobile.nearby.scripts',
			'mobile.beta.common',
		),
		'messages' => array(
			// preview.js
			'mobile-frontend-ajax-preview-loading',
			'mobile-frontend-nearby-directions',
			'mobile-frontend-nearby-link',
		),
		'scripts' => array(
			'javascripts/specials/overlays/preview.js',
		),
	),

	'mobile.nearby.watchstar' => $wgMFMobileResourceBoilerplate + array(
		'dependencies' => array(
			'mobile.nearby.scripts',
			'mobile.stable',
		),
		'scripts' => array(
			'javascripts/specials/nearby-watchstar.js',
		),
	),

	'mobile.nearby.styles' => $wgMFMobileResourceBoilerplate + array(
		'styles' => array(
			'stylesheets/specials/watchlist.css',
			'stylesheets/specials/nearby.css',
		),
	),

	'mobile.nearby' => $wgMFMobileResourceBoilerplate + array(
		'dependencies' => array(
			'mobile.stable.common',
			'mobile.nearby.styles',
			'mobile.nearby.plumbing',
			'jquery.json',
			'mobile.pagelist.styles',
		),
		'messages' => array(
			// NearbyApi.js
			'mobile-frontend-nearby-distance',
			'mobile-frontend-nearby-distance-meters',
			// other
			'mobile-frontend-nearby-error',
			'mobile-frontend-nearby-error-guidance',
			'mobile-frontend-nearby-title',
			'mobile-frontend-nearby-loading',
			'mobile-frontend-nearby-noresults',
			'mobile-frontend-nearby-noresults-guidance',
		),
		'scripts' => array(
			'javascripts/modules/nearby/NearbyApi.js',
			'javascripts/modules/nearby/Nearby.js',
		),
	),

	'mobile.nearby.scripts' => $wgMFMobileResourceBoilerplate + array(
		'dependencies' => array(
			'mobile.nearby',
		),
		'messages' => array(
			// specials/nearby.js
			'mobile-frontend-nearby-refresh',
			'mobile-frontend-nearby-lookup-ui-error',
			'mobile-frontend-nearby-lookup-ui-error-guidance',
			'mobile-frontend-nearby-requirements',
			'mobile-frontend-nearby-requirements-guidance',
		),
		'scripts' => array(
			'javascripts/specials/nearby.js',
		),
		// stop flash of unstyled content when loading from cache
		'position' => 'top',
	),
	'mobile.notifications.styles' => $wgMFMobileResourceBoilerplate + array(
		'styles' => array(
			'stylesheets/specials/notifications.css',
		),
		'position' => 'top',
	),
	'mobile.search.styles' => $wgMFMobileSpecialPageResourceBoilerplate + array(
		'styles' => array(
			'stylesheets/specials/search.css',
		),
	),
	'mobile.watchlist.scripts' => $wgMFMobileSpecialPageResourceScriptBoilerplate + array(
		'scripts' => array(
			'javascripts/specials/watchlist.js',
		),
	),
	'mobile.watchlist.styles' => $wgMFMobileSpecialPageResourceBoilerplate + array(
		'styles' => array(
			'stylesheets/common/pagelist.css',
			'stylesheets/specials/watchlist.css',
		),
	),
	'mobile.userlogin.styles' => $wgMFMobileSpecialPageResourceBoilerplate + array(
		'styles' => array(
			'stylesheets/specials/userlogin.css',
		),
	),
	'mobile.userlogin.scripts' => $wgMFMobileSpecialPageResourceBoilerplate + array(
		'scripts' => array(
			'javascripts/specials/userlogin.js',
		),
		'position' => 'top',
	),

	// Special:Uploads
	'mobile.uploads.plumbing' => $wgMFMobileResourceTemplateBoilerplate + array(
		'templates' => array(
			'specials/uploads/carousel',
			'specials/uploads/photo',
			'specials/uploads/userGallery',
		),
	),
	'mobile.uploads.scripts' => $wgMFMobileResourceBoilerplate + array(
		'dependencies' => array(
			'mobile.uploads.plumbing',
			'mobile.stable.styles',
			'mobile.stable.common',
		),
		'messages' => array(
			'mobile-frontend-photo-upload-generic',
			'mobile-frontend-donate-photo-upload-success',
			'mobile-frontend-donate-photo-first-upload-success',
			'mobile-frontend-listed-image-no-description',
			'mobile-frontend-photo-upload-user-count',
			'mobile-frontend-first-upload-wizard-new-page-1-header',
			'mobile-frontend-first-upload-wizard-new-page-1',
			'mobile-frontend-first-upload-wizard-new-page-2-header',
			'mobile-frontend-first-upload-wizard-new-page-2',
			'mobile-frontend-first-upload-wizard-new-page-3-header',
			'mobile-frontend-first-upload-wizard-new-page-3',
			'mobile-frontend-first-upload-wizard-new-page-3-ok',
		),
		'scripts' => array(
			'javascripts/widgets/carousel.js',
			'javascripts/specials/overlays/CarouselOverlay.js',
			'javascripts/specials/uploads.js',
		),
		'position' => 'top',
	),
	'mobile.uploads.styles' => $wgMFMobileSpecialPageResourceBoilerplate + array(
		'styles' => array(
			'stylesheets/specials/uploads.css',
		),
	),
	'mobile.mobilediff.styles' => $wgMFMobileSpecialPageResourceBoilerplate + array(
		'styles' => array(
			'stylesheets/specials/watchlist.css',
			'stylesheets/specials/mobilediff.css',
		),
	),

	'mobile.mobilediff.scripts.beta' => $wgMFMobileResourceBoilerplate + array(
		// should be no dependencies except mobile.head and position to top to avoid flash of unstyled content
		'dependencies' => array(
			'mobile.head',
		),
		'position' => 'top',
		'scripts' => array(
			'javascripts/externals/jsdiff.js',
			'javascripts/specials/mobilediff.js',
		),
	),

	// FIXME: temporary hack to get round CentralAuth logout screen
	'mobile.userlogout.scripts' => $wgMFMobileSpecialPageResourceScriptBoilerplate + array(
		'scripts' => array(
			'javascripts/specials/userlogin.js',
		),
	),
	'mobile.userlogout.styles' => $wgMFMobileSpecialPageResourceBoilerplate + array(
		'styles' => array(
			'stylesheets/specials/userlogin.css',
		),
	),
	'mobile.loginhandshake.scripts' => $wgMFMobileSpecialPageResourceBoilerplate + array(
		'dependencies' => array(
			'jquery.cookie',
		),
		'scripts' => array(
			'javascripts/specials/loginhandshake.js',
		),
		'position' => 'top',
	),

	//@hack: xdevice instead of device to force this module to be last in a link
	'mobile.xdevice.detect' => $wgMFMobileResourceBoilerplate + array(
		'class' => 'MobileDeviceDetectModule',
	),
) );
