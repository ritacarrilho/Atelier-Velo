import React from 'react';

const BicyclesCategories = ({ types, sizes, handleClick }) => {
    return (
        <>
            <div className='services-flex' onClick={ handleClick } >
                { types.map(( type ) => (
                    <div key={type.type}>
                        <a className="categories-label"  key={ type.id } value={ type.id } >
                            <p>{ type.type }</p>
                        </a>
                    </div>
                ))}
            </div>
            <div className='services-flex' onClick={ handleClick } >
            { sizes.map(( size ) => (
                <div key={size.size}>
                    <a className="categories-label"  key={ size.id } value={ size.id } >
                        <p>{ size.size }</p>
                    </a>
                </div>
            ))}
        </div>
    </>
    );
};

export default BicyclesCategories;