/**
 * WordPress dependencies.
 */
import { __ } from '@wordpress/i18n';

import {
	BaseControl,
	Button,
	Dropdown,
	MenuGroup,
	MenuItem,
	TextControl
} from '@wordpress/components';

import { useInstanceId } from '@wordpress/compose';

import { Fragment, useState } from '@wordpress/element';

/**
  * Internal dependencies.
  */
import { categories } from '../data.js';

function AnimationPopover({
	animationsList,
	updateAnimation,
	currentAnimationLabel,
	setCurrentAnimationLabel
}) {
	const instanceId = useInstanceId( AnimationPopover );

	const [ currentInput, setCurrentInput ] = useState( '' );
	const [ animationFound, setAnimationFound ] = useState( false );

	const getAnimations = ( animation ) => {
		let match = true;

		if ( currentInput ) {
			const inputWords = currentInput.toLowerCase().split( ' ' );
			inputWords.forEach( ( word ) => {
				if ( ! animation.label.toLowerCase().includes( word ) ) {
					match = false;
				}
			});
		}

		if ( match && ! animationFound ) {
			setAnimationFound( true );
		}

		return (
			match && (
				<MenuItem
					className={
						currentAnimationLabel === animation.label ?
							'is-selected' :
							''
					}
					onClick={ () => {
						setCurrentAnimationLabel( animation.label );
						updateAnimation( animation.value );
					} }
				>
					{ animation.label }
				</MenuItem>
			)
		);
	};

	const id = `inspector-wordtrap-animations-control-${ instanceId }`;

	return (
		<BaseControl label={ __( 'Animation', 'wordtrap' ) } id={ id }>
			<Dropdown
				contentClassName="wordtrap-animations-control__popover"
				position="bottom center"
				renderToggle={ ({ isOpen, onToggle }) => (
					<Button
						className="wordtrap-animations-control__button"
						id={ id }
						onClick={ onToggle }
						aria-expanded={ isOpen }
					>
						{ currentAnimationLabel }
					</Button>
				) }
				renderContent={ () => (
					<MenuGroup label={ __( 'Animations', 'wordtrap' ) }>
						<TextControl
							placeholder={ __( 'Search', 'wordtrap' ) }
							value={ currentInput }
							onChange={ ( e ) => {
								setCurrentInput( e );
								setAnimationFound( false );
							} }
						/>

						<div className="components-popover__items">
							{ animationsList.map( ( animation, index ) => {
								return (
									<Fragment key={index}>
										{ '' === currentInput &&
											categories.map( ( category, index ) => {
												return category.value ===
													animation.value ? (
														<Fragment key={index}>
															<div className="wordtrap-animations-control__category">
																{ category.label }
															</div>
														</Fragment>
													) : (
														''
													);
											}) }

										{ getAnimations( animation ) }
									</Fragment>
								);
							}) }

							{ ! animationFound && (
								<div>
									{ __(
										'Nothing found. Try searching for something else!',
										'wordtrap'
									) }
								</div>
							) }
						</div>
					</MenuGroup>
				) }
			/>
		</BaseControl>
	);
}

export default AnimationPopover;
