import { registerPlugin } from '@wordpress/plugins';
import { PluginDocumentSettingPanel } from '@wordpress/editor';
import { TextControl } from '@wordpress/components';
import { useSelect, useDispatch } from '@wordpress/data';
import { useMemo } from '@wordpress/element';

const MetaPanel = () => {
	const meta = useSelect(
		( select ) => select( 'core/editor' ).getEditedPostAttribute( 'meta' ),
		[]
	);

	const { editPost } = useDispatch( 'core/editor' );

	const isbn = useMemo( () => meta?.awesome_bookly_isbn ?? '', [ meta ] );

	const updateISBN = ( value ) => {
		editPost( {
			meta: {
				...meta,
				awesome_bookly_isbn: value,
			},
		} );
	};

	return (
		<PluginDocumentSettingPanel
			name="awesome-bookly-book-details"
			title="Book Details"
			initialOpen={ true }
		>
			<TextControl
				label="ISBN"
				value={ isbn }
				onChange={ updateISBN }
				help="Enter the ISBN number."
			/>
		</PluginDocumentSettingPanel>
	);
};

registerPlugin( 'awesome-bookly-meta-panel', {
	render: MetaPanel,
} );
