import { registerPlugin } from '@wordpress/plugins';
import { PluginDocumentSettingPanel } from '@wordpress/editor';
import { TextControl } from '@wordpress/components';
import { useSelect, useDispatch, select } from '@wordpress/data';
import { useMemo } from '@wordpress/element';

const MetaPanel = () => {
	const postType = useSelect(
		( select ) => select( 'core/editor' ).getCurrentPostType(),
		[]
	);

	if ( postType != 'asm_bookly_book' ) {
		return null;
	}

	const meta = useSelect(
		( select ) => select( 'core/editor' ).getEditedPostAttribute( 'meta' ),
		[]
	);
	console.log( meta );

	const { editPost } = useDispatch( 'core/editor' );

	// "awesome_bookly_pub_date": "",
	// "awesome_bookly_lang": "",
	// "awesome_bookly_page_count": 0,
	// "awesome_bookly_price": 0,
	// "awesome_bookly_gallery_images": []

	const isbn = useMemo( () => meta?.awesome_bookly_isbn ?? '', [ meta ] );
	const date = useMemo( () => meta?.awesome_bookly_pub_date ?? '', [ meta ] );
	const lang = useMemo( () => meta?.awesome_bookly_lang ?? '', [ meta ] );
	const pgCount = useMemo(
		() => meta?.awesome_bookly_page_count ?? '',
		[ meta ]
	);
	const price = useMemo( () => meta?.awesome_bookly_price ?? '', [ meta ] );
	const images = useMemo(
		() => meta?.awesome_bookly_gallery_images ?? '',
		[ meta ]
	);

	const updateISBN = ( value ) => {
		editPost( {
			meta: {
				...meta,
				awesome_bookly_isbn: value,
			},
		} );
	};

	const updateDate = ( value ) => {
		editPost( {
			meta: {
				...meta,
				awesome_bookly_pub_date: value,
			},
		} );
	};

	const updateLang = ( value ) => {
		editPost( {
			meta: {
				...meta,
				awesome_bookly_lang: value,
			},
		} );
	};

	const updatePgCount = ( value ) => {
		editPost( {
			meta: {
				...meta,
				awesome_bookly_page_count: value,
			},
		} );
	};

	const updatePrice = ( value ) => {
		editPost( {
			meta: {
				...meta,
				awesome_bookly_price: value,
			},
		} );
	};

	const updateImages = ( value ) => {
		editPost( {
			meta: {
				...meta,
				awesome_bookly_gallery_images: value,
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

			<TextControl
				label="Publication Date"
				value={ date }
				onChange={ updateDate }
				help="Enter the publication date."
			/>

			<TextControl
				label="Language"
				value={ lang }
				onChange={ updateLang }
				help="Enter the language of the book."
			/>

			<TextControl
				label="Page Count"
				value={ pgCount }
				onChange={ updatePgCount }
				help="Enter the number of pages."
			/>

			<TextControl
				label="Price"
				value={ price }
				onChange={ updatePrice }
				help="Enter the price of the book."
			/>

			<TextControl
				label="Gallery Images"
				value={ images }
				onChange={ updateImages }
				help="Enter the gallery image URLs, separated by commas."
			/>
		</PluginDocumentSettingPanel>
	);
};

registerPlugin( 'awesome-bookly-meta-panel', {
	render: MetaPanel,
} );
