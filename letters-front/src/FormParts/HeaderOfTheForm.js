import React from 'react';

const HeaderOfTheForm = ({ title, char }) => {
    return (
        <div className="phoneme-form-header">
            <div className="phoneme-char-wrapper">
                <div className="phoneme-char-display">
                    {char}
                </div>
            </div>
            <h2 className="phoneme-form-title">{title}</h2>
        </div>
    );
};

export default HeaderOfTheForm;