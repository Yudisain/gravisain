import { registerPlugin } from '@wordpress/plugins';
import { PluginSidebar } from '@wordpress/edit-post';
import { PanelBody, ButtonGroup, Button, ToggleControl, TextControl, SelectControl } from '@wordpress/components';
import { useSelect, useDispatch, dispatch, subscribe, select } from '@wordpress/data';
import apiFetch from '@wordpress/api-fetch';
import { __ } from '@wordpress/i18n';
import { useEffect } from '@wordpress/element';

// Sync preview meta to our custom REST API immediately on change
let lastMetaString = '';
subscribe( () => {
	const coreEditor = select( 'core/editor' );
	if ( ! coreEditor ) {
		return;
	}
	const meta = coreEditor.getEditedPostAttribute( 'meta' );
	if ( meta ) {
		const currentMetaString = JSON.stringify( meta );
		if ( currentMetaString !== lastMetaString && lastMetaString !== '' ) {
			lastMetaString = currentMetaString;
			const postId = coreEditor.getCurrentPostId();
			if ( postId ) {
				apiFetch( {
					path: `/gravisain/v1/preview-meta/${ postId }`,
					method: 'POST',
					data: { meta: meta },
				} ).catch( () => {} );
			}
		} else if ( lastMetaString === '' ) {
			lastMetaString = currentMetaString; // Initialize on first load without triggering API
		}
	}
} );

const GravisainLogoIcon = (
	<svg
		xmlns="http://www.w3.org/2000/svg"
		viewBox="0 0 512 512"
		width="24"
		height="24"
		fill="none"
	>
		<path d="M256 48 L420 200" stroke="currentColor" strokeWidth="45" strokeLinecap="round" strokeLinejoin="round" fill="none" />
		<path d="M256 48 L92 192" stroke="currentColor" strokeWidth="45" strokeLinecap="round" strokeLinejoin="round" fill="none" />
		<path d="M92 288 L256 464" stroke="currentColor" strokeWidth="45" strokeLinecap="round" strokeLinejoin="round" fill="none" />
		<path d="M420 288 L256 464" stroke="currentColor" strokeWidth="45" strokeLinecap="round" strokeLinejoin="round" fill="none" />
		<path d="M92 192 L256 336" stroke="currentColor" strokeWidth="45" strokeLinecap="round" strokeLinejoin="round" fill="none" />
		<path d="M160 205 H420" stroke="currentColor" strokeWidth="45" strokeLinecap="round" strokeLinejoin="round" fill="none" />
		<path d="M256 205 V330" stroke="currentColor" strokeWidth="45" strokeLinecap="round" strokeLinejoin="round" fill="none" />
		<path d="M285 205 L385 318" stroke="currentColor" strokeWidth="45" strokeLinecap="round" strokeLinejoin="round" fill="none" />
	</svg>
);

const LayoutIcons = {
	default: (
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" stroke="currentColor" strokeWidth="2.5">
			<circle cx="24" cy="24" r="16" />
			<path d="M8 24h32M24 8a24 24 0 0 1 0 32a24 24 0 0 1 0-32z" />
			<path d="M24 8v32" />
		</svg>
	),
	normal: (
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" stroke="currentColor" strokeWidth="2.5">
			<rect x="6" y="8" width="36" height="32" rx="2" />
			<path d="M12 16h24M12 22h24M12 28h18M12 34h20" />
		</svg>
	),
	narrow: (
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" stroke="currentColor" strokeWidth="2.5">
			<rect x="6" y="8" width="36" height="32" rx="2" />
			<path d="M16 16h16M16 22h16M16 28h12M16 34h14" />
		</svg>
	),
	fullwidth: (
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" stroke="currentColor" strokeWidth="2.5">
			<rect x="4" y="8" width="40" height="32" rx="2" />
			<path d="M8 16h32M8 22h32M8 28h26M8 34h28" />
		</svg>
	),
	leftSidebar: (
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" stroke="currentColor" strokeWidth="2.5">
			<rect x="6" y="8" width="36" height="32" rx="2" />
			<line x1="18" y1="8" x2="18" y2="40" />
			<path d="M22 16h16M22 22h16M22 28h12M22 34h14" />
			<rect x="10" y="14" width="4" height="20" fill="currentColor" stroke="none" />
		</svg>
	),
	rightSidebar: (
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" stroke="currentColor" strokeWidth="2.5">
			<rect x="6" y="8" width="36" height="32" rx="2" />
			<line x1="30" y1="8" x2="30" y2="40" />
			<path d="M10 16h16M10 22h16M10 28h12M10 34h14" />
			<rect x="34" y="14" width="4" height="20" fill="currentColor" stroke="none" />
		</svg>
	),
};

const SegmentedButtons = ( { label, value, options, onChange } ) => {
	return (
		<div style={ { marginBottom: 20 } }>
			{ label && (
				<p style={ { marginBottom: 8, fontWeight: 600, fontSize: '13px', color: '#1e293b' } }>
					{ label }
				</p>
			) }
			<ButtonGroup style={ { display: 'flex', width: '100%' } }>
				{ options.map( ( option ) => {
					const isSelected = value === option.value;
					return (
						<Button
							key={ option.value }
							variant={ isSelected ? 'primary' : 'secondary' }
							onClick={ () => onChange( option.value ) }
							style={ {
								flex: 1,
								justifyContent: 'center',
								fontSize: '11px',
								fontWeight: isSelected ? 700 : 500,
								textTransform: 'uppercase',
								padding: '6px 8px',
								height: 'auto',
								minHeight: '32px',
							} }
						>
							{ option.label }
						</Button>
					);
				} ) }
			</ButtonGroup>
		</div>
	);
};

const PageLayoutGrid = ( { value, onChange, sidebarChoice, onChangeChoice } ) => {
	const layouts = [
		{ value: 'default', label: 'DEFAULT', icon: LayoutIcons.default },
		{ value: 'normal', label: 'NORMAL', icon: LayoutIcons.normal },
		{ value: 'narrow', label: 'NARROW', icon: LayoutIcons.narrow },
		{ value: 'no-sidebar', label: 'FULLWIDTH', icon: LayoutIcons.fullwidth },
		{ value: 'left-sidebar', label: 'LEFT SIDEBAR', icon: LayoutIcons.leftSidebar },
		{ value: 'right-sidebar', label: 'RIGHT SIDEBAR', icon: LayoutIcons.rightSidebar },
	];

	return (
		<div style={ { marginBottom: 20 } }>
			<p style={ { marginBottom: 8, fontWeight: 600, fontSize: '13px', color: '#1e293b' } }>
				{ __( 'Page Layout', 'gravisain' ) }
			</p>
			<div
				style={ {
					display: 'grid',
					gridTemplateColumns: 'repeat(3, 1fr)',
					gap: '8px',
				} }
			>
				{ layouts.map( ( item ) => {
					const isSelected = value === item.value;
					return (
						<button
							key={ item.value }
							type="button"
							onClick={ () => onChange( item.value ) }
							style={ {
								display: 'flex',
								flexDirection: 'column',
								alignItems: 'center',
								justifyContent: 'center',
								padding: '10px 4px 6px',
								border: isSelected ? '2px solid #007cba' : '1px solid #cbd5e1',
								borderRadius: '4px',
								background: isSelected ? '#f0f9ff' : '#ffffff',
								color: isSelected ? '#007cba' : '#64748b',
								cursor: 'pointer',
								transition: 'all 0.15s ease',
							} }
						>
							<div style={ { width: '32px', height: '32px', marginBottom: '6px' } }>
								{ item.icon }
							</div>
							<span style={ { fontSize: '10px', fontWeight: isSelected ? 700 : 500 } }>
								{ item.label }
							</span>
						</button>
					);
				} ) }
			</div>
			{ ( value === 'left-sidebar' || value === 'right-sidebar' || value === 'default' ) && (
				<div style={ { marginTop: '12px' } }>
					<SelectControl
						label={ __( 'Page sidebar', 'gravisain' ) }
						value={ sidebarChoice || 'default' }
						options={ [
							{ label: __( 'Default', 'gravisain' ), value: 'default' },
							{ label: __( 'Main Blog Sidebar', 'gravisain' ), value: 'sidebar-1' },
						] }
						onChange={ onChangeChoice }
					/>
				</div>
			) }
		</div>
	);
};

const PageSettingsSidebar = () => {
	useEffect( () => {
		try {
			const editPostDispatch = dispatch( 'core/edit-post' );
			if ( editPostDispatch && typeof editPostDispatch.pinItem === 'function' ) {
				editPostDispatch.pinItem( 'gravisain-page-settings' );
				editPostDispatch.pinItem( 'gravisain-page-settings/gravisain-page-settings' );
			}
		} catch ( e ) {}
	}, [] );

	const {
		titleMode,
		sidebarLayout,
		sidebarChoice,
		transparentHeader,
		contentStyle,
		verticalSpacing,
		showFeaturedImage,
		bodyClass,
		hideHeader,
		hideFooter,
	} = useSelect( ( select ) => {
		const meta = select( 'core/editor' ).getEditedPostAttribute( 'meta' ) || {};
		let currentTitleMode = meta._gravisain_title_mode;
		if ( ! currentTitleMode || currentTitleMode === 'default' ) {
			currentTitleMode = meta._gravisain_hide_title ? 'hide' : 'default';
		}
		return {
			titleMode: currentTitleMode,
			sidebarLayout: meta._gravisain_sidebar_layout || 'default',
			sidebarChoice: meta._gravisain_sidebar_choice || 'default',
			transparentHeader: meta._gravisain_transparent_header || 'default',
			contentStyle: meta._gravisain_content_style || 'default',
			verticalSpacing: meta._gravisain_vertical_spacing || 'default',
			showFeaturedImage: meta._gravisain_show_featured_image || 'default',
			bodyClass: meta._gravisain_body_class || '',
			hideHeader: !! meta._gravisain_hide_header,
			hideFooter: !! meta._gravisain_hide_footer,
		};
	}, [] );

	useEffect( () => {
		const applyClasses = ( targetBody ) => {
			if ( ! targetBody ) return;
			targetBody.classList.toggle( 'gravisain-editor-hide-title', titleMode === 'hide' );
			targetBody.classList.toggle( 'gravisain-editor-hide-header', hideHeader );
			targetBody.classList.toggle( 'gravisain-editor-hide-footer', hideFooter );
			[ 'default', 'normal', 'narrow', 'no-sidebar', 'left-sidebar', 'right-sidebar' ].forEach( ( layout ) => {
				targetBody.classList.toggle( `gravisain-page-layout-${ layout }`, sidebarLayout === layout && layout !== 'default' );
			} );
			[ 'default', 'boxed', 'unboxed' ].forEach( ( style ) => {
				targetBody.classList.toggle( `gravisain-content-style-${ style }`, contentStyle === style && style !== 'default' );
			} );
			[ 'default', 'enable', 'disable', 'top-only', 'bottom-only' ].forEach( ( spacing ) => {
				targetBody.classList.toggle( `gravisain-spacing-${ spacing }`, verticalSpacing === spacing && spacing !== 'default' );
			} );
		};

		const getStyles = () => `
			/* Page Layout: Narrow */
			body.gravisain-page-layout-narrow .editor-styles-wrapper .is-root-container > *:not(.alignfull),
			body.gravisain-page-layout-narrow .editor-styles-wrapper .block-editor-block-list__layout.is-root-container > *:not(.alignfull),
			body.gravisain-page-layout-narrow .is-root-container > *:not(.alignfull),
			body.gravisain-page-layout-narrow .block-editor-block-list__layout.is-root-container > *:not(.alignfull) {
				max-width: 800px !important;
				margin-left: auto !important;
				margin-right: auto !important;
			}
			body.gravisain-page-layout-narrow .editor-styles-wrapper .is-root-container > .alignwide,
			body.gravisain-page-layout-narrow .editor-styles-wrapper .block-editor-block-list__layout.is-root-container > .alignwide,
			body.gravisain-page-layout-narrow .is-root-container > .alignwide,
			body.gravisain-page-layout-narrow .block-editor-block-list__layout.is-root-container > .alignwide {
				max-width: 800px !important;
			}

			/* Page Layout: Normal */
			body.gravisain-page-layout-normal .editor-styles-wrapper .is-root-container > *:not(.alignfull),
			body.gravisain-page-layout-normal .editor-styles-wrapper .block-editor-block-list__layout.is-root-container > *:not(.alignfull),
			body.gravisain-page-layout-normal .is-root-container > *:not(.alignfull),
			body.gravisain-page-layout-normal .block-editor-block-list__layout.is-root-container > *:not(.alignfull) {
				max-width: var(--gravisain-container-width, 1200px) !important;
				margin-left: auto !important;
				margin-right: auto !important;
			}

			/* Page Layout: Fullwidth / No-Sidebar */
			body.gravisain-page-layout-no-sidebar .editor-styles-wrapper .is-root-container > *:not(.alignfull),
			body.gravisain-page-layout-no-sidebar .editor-styles-wrapper .block-editor-block-list__layout.is-root-container > *:not(.alignfull),
			body.gravisain-page-layout-no-sidebar .is-root-container > *:not(.alignfull),
			body.gravisain-page-layout-no-sidebar .block-editor-block-list__layout.is-root-container > *:not(.alignfull) {
				max-width: 100% !important;
				padding-left: 2rem !important;
				padding-right: 2rem !important;
			}

			/* Page Layout: Left Sidebar & Right Sidebar preview simulation */
			body.gravisain-page-layout-left-sidebar .editor-styles-wrapper .is-root-container,
			body.gravisain-page-layout-left-sidebar .is-root-container {
				padding-left: 300px !important;
				position: relative;
			}
			body.gravisain-page-layout-left-sidebar .editor-styles-wrapper .is-root-container::before,
			body.gravisain-page-layout-left-sidebar .is-root-container::before {
				content: "Left Sidebar Area (${ sidebarChoice || 'default' })";
				position: absolute;
				left: 1.5rem;
				top: 2rem;
				width: 250px;
				height: calc(100% - 4rem);
				min-height: 350px;
				background: #f8fafc;
				border: 2px dashed #cbd5e1;
				border-radius: 8px;
				display: flex;
				align-items: center;
				justify-content: center;
				color: #64748b;
				font-size: 13px;
				font-weight: 600;
				pointer-events: none;
			}

			body.gravisain-page-layout-right-sidebar .editor-styles-wrapper .is-root-container,
			body.gravisain-page-layout-right-sidebar .is-root-container {
				padding-right: 300px !important;
				position: relative;
			}
			body.gravisain-page-layout-right-sidebar .editor-styles-wrapper .is-root-container::after,
			body.gravisain-page-layout-right-sidebar .is-root-container::after {
				content: "Right Sidebar Area (${ sidebarChoice || 'default' })";
				position: absolute;
				right: 1.5rem;
				top: 2rem;
				width: 250px;
				height: calc(100% - 4rem);
				min-height: 350px;
				background: #f8fafc;
				border: 2px dashed #cbd5e1;
				border-radius: 8px;
				display: flex;
				align-items: center;
				justify-content: center;
				color: #64748b;
				font-size: 13px;
				font-weight: 600;
				pointer-events: none;
			}

			/* Hide Title inside editor preview */
			body.gravisain-editor-hide-title .editor-post-title,
			body.gravisain-editor-hide-title .wp-block-post-title,
			body.gravisain-editor-hide-title .editor-post-title__block {
				display: none !important;
			}

			/* Hide Header / Footer block template parts inside editor preview */
			body.gravisain-editor-hide-header .wp-block-template-part[className*="header"],
			body.gravisain-editor-hide-header header.wp-block-template-part {
				display: none !important;
			}
			body.gravisain-editor-hide-footer .wp-block-template-part[className*="footer"],
			body.gravisain-editor-hide-footer footer.wp-block-template-part {
				display: none !important;
			}

			/* Content Style: Boxed */
			body.gravisain-content-style-boxed .editor-styles-wrapper .is-root-container,
			body.gravisain-content-style-boxed .editor-styles-wrapper .block-editor-block-list__layout.is-root-container,
			body.gravisain-content-style-boxed .is-root-container,
			body.gravisain-content-style-boxed .block-editor-block-list__layout.is-root-container {
				background-color: var(--gravisain-content-bg, #ffffff) !important;
				border-radius: 12px !important;
				box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03) !important;
				padding: 2.5rem !important;
				max-width: var(--gravisain-container-width, 1200px);
				margin-top: 2rem !important;
				margin-bottom: 2rem !important;
			}
			body.gravisain-content-style-boxed.gravisain-page-layout-narrow .editor-styles-wrapper .is-root-container,
			body.gravisain-content-style-boxed.gravisain-page-layout-narrow .editor-styles-wrapper .block-editor-block-list__layout.is-root-container,
			body.gravisain-content-style-boxed.gravisain-page-layout-narrow .is-root-container,
			body.gravisain-content-style-boxed.gravisain-page-layout-narrow .block-editor-block-list__layout.is-root-container {
				max-width: 800px !important;
			}

			/* Content Style: Unboxed */
			body.gravisain-content-style-unboxed .editor-styles-wrapper .is-root-container,
			body.gravisain-content-style-unboxed .editor-styles-wrapper .block-editor-block-list__layout.is-root-container,
			body.gravisain-content-style-unboxed .is-root-container,
			body.gravisain-content-style-unboxed .block-editor-block-list__layout.is-root-container {
				background-color: transparent !important;
				box-shadow: none !important;
				border: none !important;
				padding: 0 !important;
			}
		`;

		const applyLiveStyles = ( targetDoc, targetBody ) => {
			if ( ! targetDoc || ! targetBody ) return;
			applyClasses( targetBody );
			let styleEl = targetDoc.getElementById( 'gravisain-editor-preview-live-styles' );
			if ( ! styleEl ) {
				styleEl = targetDoc.createElement( 'style' );
				styleEl.id = 'gravisain-editor-preview-live-styles';
				targetDoc.head.appendChild( styleEl );
			}
			styleEl.textContent = getStyles();
		};

		applyLiveStyles( document, document.body );
		const checkAndApplyIframe = () => {
			const iframe = document.querySelector( 'iframe[name="editor-canvas"]' );
			if ( iframe && iframe.contentDocument && iframe.contentDocument.body ) {
				applyLiveStyles( iframe.contentDocument, iframe.contentDocument.body );
			}
		};
		checkAndApplyIframe();
		const interval = setInterval( checkAndApplyIframe, 1000 );
		return () => clearInterval( interval );
	}, [ titleMode, hideHeader, hideFooter, sidebarLayout, sidebarChoice, contentStyle, verticalSpacing ] );

	const { editPost } = useDispatch( 'core/editor' );

	const setMeta = ( key, val ) => {
		editPost( { meta: { [ key ]: val } } );
	};

	const setTitleMode = ( value ) => {
		editPost( {
			meta: {
				_gravisain_title_mode: value,
				_gravisain_hide_title: value === 'hide',
			},
		} );
	};

	return (
		<PluginSidebar
			name="gravisain-page-settings"
			title={ __( 'Page Settings', 'gravisain' ) }
			icon={ GravisainLogoIcon }
		>
			<div style={ { padding: '16px' } }>
				<SegmentedButtons
					label={ __( 'Transparent Header', 'gravisain' ) }
					value={ transparentHeader }
					options={ [
						{ value: 'default', label: __( 'DEFAULT', 'gravisain' ) },
						{ value: 'enable', label: __( 'ENABLE', 'gravisain' ) },
						{ value: 'disable', label: __( 'DISABLE', 'gravisain' ) },
					] }
					onChange={ ( val ) => setMeta( '_gravisain_transparent_header', val ) }
				/>

				<SegmentedButtons
					label={ __( 'Page Title', 'gravisain' ) }
					value={ titleMode }
					options={ [
						{ value: 'default', label: __( 'DEFAULT', 'gravisain' ) },
						{ value: 'show', label: __( 'ENABLE', 'gravisain' ) },
						{ value: 'hide', label: __( 'DISABLE', 'gravisain' ) },
					] }
					onChange={ setTitleMode }
				/>

				<PageLayoutGrid
					value={ sidebarLayout }
					onChange={ ( val ) => setMeta( '_gravisain_sidebar_layout', val ) }
					sidebarChoice={ sidebarChoice }
					onChangeChoice={ ( val ) => setMeta( '_gravisain_sidebar_choice', val ) }
				/>

				<SegmentedButtons
					label={ __( 'Content Style', 'gravisain' ) }
					value={ contentStyle }
					options={ [
						{ value: 'default', label: __( 'DEFAULT', 'gravisain' ) },
						{ value: 'boxed', label: __( 'BOXED', 'gravisain' ) },
						{ value: 'unboxed', label: __( 'UNBOXED', 'gravisain' ) },
					] }
					onChange={ ( val ) => setMeta( '_gravisain_content_style', val ) }
				/>

				<SegmentedButtons
					label={ __( 'Content Vertical Spacing', 'gravisain' ) }
					value={ verticalSpacing }
					options={ [
						{ value: 'default', label: __( 'DEFAULT', 'gravisain' ) },
						{ value: 'enable', label: __( 'ENABLE', 'gravisain' ) },
						{ value: 'disable', label: __( 'DISABLE', 'gravisain' ) },
					] }
					onChange={ ( val ) => setMeta( '_gravisain_vertical_spacing', val ) }
				/>
				{ ( verticalSpacing === 'enable' || verticalSpacing === 'top-only' || verticalSpacing === 'bottom-only' ) && (
					<div style={ { marginTop: '-12px', marginBottom: '20px' } }>
						<ButtonGroup style={ { display: 'flex', width: '100%' } }>
							<Button
								variant={ verticalSpacing === 'top-only' ? 'primary' : 'secondary' }
								onClick={ () => setMeta( '_gravisain_vertical_spacing', verticalSpacing === 'top-only' ? 'enable' : 'top-only' ) }
								style={ { flex: 1, justifyContent: 'center', fontSize: '11px', padding: '4px 8px' } }
							>
								{ __( 'TOP ONLY', 'gravisain' ) }
							</Button>
							<Button
								variant={ verticalSpacing === 'bottom-only' ? 'primary' : 'secondary' }
								onClick={ () => setMeta( '_gravisain_vertical_spacing', verticalSpacing === 'bottom-only' ? 'enable' : 'bottom-only' ) }
								style={ { flex: 1, justifyContent: 'center', fontSize: '11px', padding: '4px 8px' } }
							>
								{ __( 'BOTTOM ONLY', 'gravisain' ) }
							</Button>
						</ButtonGroup>
					</div>
				) }

				<SegmentedButtons
					label={ __( 'Show Featured Image', 'gravisain' ) }
					value={ showFeaturedImage }
					options={ [
						{ value: 'default', label: __( 'DEFAULT', 'gravisain' ) },
						{ value: 'enable', label: __( 'ENABLE', 'gravisain' ) },
						{ value: 'disable', label: __( 'DISABLE', 'gravisain' ) },
					] }
					onChange={ ( val ) => setMeta( '_gravisain_show_featured_image', val ) }
				/>

				<div style={ { marginBottom: 20 } }>
					<TextControl
						label={ __( 'ADDITIONAL CSS CLASS(ES)', 'gravisain' ) }
						value={ bodyClass }
						onChange={ ( val ) => setMeta( '_gravisain_body_class', val ) }
						help={ __( 'The class(es) will be added to the body of this page. Separate multiple classes with a space.', 'gravisain' ) }
					/>
				</div>

				<div style={ { borderTop: '1px solid #e2e8f0', paddingTop: 16 } }>
					<ToggleControl
						label={ __( 'Disable Header', 'gravisain' ) }
						checked={ hideHeader }
						onChange={ ( val ) => setMeta( '_gravisain_hide_header', val ? 1 : 0 ) }
						style={ { marginBottom: 12 } }
					/>
					<ToggleControl
						label={ __( 'Disable Footer', 'gravisain' ) }
						checked={ hideFooter }
						onChange={ ( val ) => setMeta( '_gravisain_hide_footer', val ? 1 : 0 ) }
					/>
				</div>
			</div>
		</PluginSidebar>
	);
};

registerPlugin( 'gravisain-page-settings', {
	icon: GravisainLogoIcon,
	render: PageSettingsSidebar,
} );
