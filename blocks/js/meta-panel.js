import { registerPlugin } from '@wordpress/plugins';
import { PluginDocumentSettingPanel } from '@wordpress/editor';
import { useEntityProp } from '@wordpress/core-data';
import { TextControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

const BooklyMetaPanel = () => {
	const [ meta, setMeta ] = useEntityProp(
		'postType',
		'asm_bookly_book',
		'meta'
	);

	// "awesome_bookly_gallery_images": []

	return (
		<PluginDocumentSettingPanel
			title={ __( 'Book Details', 'awesome-bookly' ) }
			icon="book"
		>
			<TextControl
				label="ISBN"
				value={ meta.awesome_bookly_isbn || '' }
				onChange={ ( value ) =>
					setMeta( { ...meta, awesome_bookly_isbn: value } )
				}
			/>
			{ /* Add publication date, date picker  */ }
			<TextControl
				label="Publication Date"
				value={ meta.awesome_bookly_pub_date || '' }
				onChange={ ( value ) =>
					setMeta( { ...meta, awesome_bookly_pub_date: value } )
				}
			/>
			<TextControl
				label="Language"
				value={ meta.awesome_bookly_lang || '' }
				onChange={ ( value ) =>
					setMeta( { ...meta, awesome_bookly_lang: value } )
				}
			/>
			<TextControl
				label="Page Count"
				type="number"
				value={ meta.awesome_bookly_page_count || '' }
				onChange={ ( value ) =>
					setMeta( { ...meta, awesome_bookly_page_count: value } )
				}
			/>
			<TextControl
				label="Price"
				type="number"
				value={ meta.awesome_bookly_price || '' }
				onChange={ ( value ) =>
					setMeta( { ...meta, awesome_bookly_price: value } )
				}
			/>
			{ /* Add gallery images, image uploader */ }
		</PluginDocumentSettingPanel>
	);
};

registerPlugin( 'bookly-meta-panel', { render: BooklyMetaPanel } );
