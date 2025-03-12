import React, { useState, useEffect } from 'react';
import PhonemeActivityForm  from './PhonemeActivityForm ';

const MainComponent = () => {
    const [activities, setActivities] = useState([]);
    const [currentIndex, setCurrentIndex] = useState(0);

    useEffect(() => {
        const mockData = [
            {
                id: 1,
                phoneme_id: 1,
                type: 'نوع الهمزة',
                is_active: true,
                grammatical_effect: 'التأثير النحوي',
                examples: 'مثال',
                phoneme: {
                    char: 'أ',
                    symbol: 'Hamza',
                    type: 'Consonant',
                    voicing: 'Voiced',
                    place_manner: 'Glottal',
                    duration: 100
                }
            },
            {
                id: 2,
                phoneme_id: 2,
                type: 'نوع الهمزة',
                is_active: false,
                grammatical_effect: 'التأثير النحوي',
                examples: 'مثال آخر',
                phoneme: {
                    char: 'ب',
                    symbol: 'Ba',
                    type: 'Consonant',
                    voicing: 'Voiced',
                    place_manner: 'Bilabial',
                    duration: 120
                }
            }
        ];
        setActivities(mockData);
        console.log('Activities Set:', mockData);
    }, []);

    const handleNext = () => {
        setCurrentIndex((prevIndex) => {
            const newIndex = (prevIndex + 1) % activities.length;
            console.log('Previous Index:', prevIndex);
            console.log('New Index:', newIndex);
            return newIndex;
        });
    };

    return (
        <div>
            {activities.length > 0 && (
                <PhonemeActivityForm  
                    activity={activities[currentIndex]}
                    onNext={handleNext}
                />
            )}
        </div>
    );
};

export default MainComponent;