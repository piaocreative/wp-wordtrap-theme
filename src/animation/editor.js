/**
 * WordPress dependencies.
 */
import { __ } from '@wordpress/i18n';

import { SelectControl } from '@wordpress/components';

import {
	Fragment,
	useState,
	useEffect
} from '@wordpress/element';

/**
  * Internal dependencies.
  */
import {
	animationsList,
	delayList,
	outAnimation,
	speedList
} from './data.js';

import AnimationPopover from './components/animation-popover.js';

import ControlPanelControl from './../blocks/components/control-panel-control/index.js';

import { memo } from '@wordpress/element';

function AnimationControls({
	clientId,
	attributes,
	setAttributes
}) {
	useEffect( () => {
		let classes;

		if ( attributes.className ) {
			classes = attributes.className;
			classes = classes.split( ' ' );

			let animationClass = Array.from( animationsList ).find( ( i ) => {
				return classes.find( ( v ) => v === i.value );
			});

			const delayClass = Array.from( delayList ).find( ( i ) => {
				return classes.find( ( v ) => v === i.value );
			});

			const speedClass = Array.from( speedList ).find( ( i ) => {
				return classes.find( ( v ) => v === i.value );
			});

			setAnimation( animationClass ? animationClass.value : 'none' );
			setDelay( delayClass ? delayClass.value : 'none' );
			setSpeed( speedClass ? speedClass.value : 'none' );
			setCurrentAnimationLabel(
				animationClass ? animationClass.label : 'none'
			);
		}

	}, []);

	const [ animation, setAnimation ] = useState( 'none' );
	const [ delay, setDelay ] = useState( 'none' );
	const [ speed, setSpeed ] = useState( 'none' );
	const [ currentAnimationLabel, setCurrentAnimationLabel ] = useState( __( 'None', 'wordtrap' ) );

	const updateAnimation = ( e ) => {
		let classes;
		let animationValue = 'none' !== e ? e : '';

		if ( attributes.className ) {
			classes = attributes.className;
			classes = classes.split( ' ' );
			const exists = classes.find( ( i ) => i === animation );
			const animatedExists = classes.find( ( i ) => 'animated' === i );

			if ( ! animatedExists ) {
				classes.push( 'animated' );
			}

			if ( exists ) {
				classes = classes
					.join( ' ' )
					.replace( animation, animationValue );
			} else {
				classes.push( animationValue );
				classes = classes.join( ' ' );
			}
		} else {
			classes = `animated ${ animationValue }`;
		}

		if ( 'none' === e ) {
			classes = classes
				.replace( 'animated', '' )
				.replace( delay, '' )
				.replace( speed, '' );

			setDelay( 'none' );
			setSpeed( 'none' );
		}

		classes = classes.replace( /\s+/g, ' ' ).trim();

		if ( '' === classes ) {
			classes = undefined;
		}

		setAnimation( e );
		setAttributes({ className: classes });

		let block = document.querySelector( `#block-${ clientId } .animated` ) || document.querySelector( `#block-${ clientId }.animated` );

		if ( block ) {
			outAnimation.forEach( ( i ) => {
				const isOut = block.className.includes( i );

				if ( isOut ) {
					block.addEventListener( 'animationend', () => {
						block.classList.remove( i );

						block.addEventListener( 'animationstart', () => {
							block.classList.remove( i );
						});
					});
				}
			});
		}
	};

	const updateAnimConfig = ( type, oldValue, newValue, callback ) => {
		let template = '';

		const oldClassName = template + oldValue;
		const newClassName = 'none' !== newValue ? template + newValue : '';
		let classes;

		if ( attributes.className ) {
			classes = attributes.className;
			classes = classes.split( ' ' );
			const exists = classes.find( ( i ) => i === oldClassName );

			if ( exists ) {
				classes = classes.join( ' ' ).replace( oldClassName, newClassName );
			} else {
				classes.push( newClassName );
				classes = classes.join( ' ' ).trim();
			}
		} else {
			classes = newClassName;
		}

		classes = classes.replace( /\s+/g, ' ' );

		if ( '' === classes ) {
			classes = undefined;
		}

		setAttributes({ className: classes });
		callback?.();
	};

	return (
		<Fragment>
			<ControlPanelControl
				label={ __( 'Loading Animations', 'wordtrap' ) }
			>
				<div className="wordtrap-animations-control">
					<AnimationPopover
						animationsList={ animationsList }
						updateAnimation={ updateAnimation }
						currentAnimationLabel={ currentAnimationLabel }
						setCurrentAnimationLabel={ setCurrentAnimationLabel }
					/>

					{ 'none' !== animation && (
						<Fragment>
							<SelectControl
								label={ __( 'Delay', 'wordtrap' ) }
								value={ delay || 'none' }
								options={ delayList }
								onChange={  value => updateAnimConfig( 'default', delay, value, () => setDelay( value ) ) }
							/>

							<SelectControl
								label={ __( 'Speed', 'wordtrap' ) }
								value={ speed || 'none' }
								options={ speedList }
								onChange={ value => updateAnimConfig( 'default', speed, value, () => setSpeed( value ) ) }
							/>
						</Fragment>
					) }
				</div>
			</ControlPanelControl>
			
		</Fragment>
	);
}

export default memo( AnimationControls );
