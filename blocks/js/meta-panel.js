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
		</PluginDocumentSettingPanel>
	);
};

registerPlugin( 'bookly-meta-panel', { render: BooklyMetaPanel } );
