import React, { useState, useEffect } from 'react';
import axios from 'axios';
import PhonemeActivityForm  from './PhonemeActivityForm ';

const MainComponent = () => {
    const [activities, setActivities] = useState([]);
    const [currentIndex, setCurrentIndex] = useState(0);

    useEffect(() => {
        const fetchActivities = async () => {
            try {
                console.log('Fetching Activities...');
                const response = await axios.get('http://127.0.0.1:8000/api/phoneme-activities');
                console.log('Activities Fetched:', response.data);
                setActivities(response.data);
                console.log('Activities Set:', response.data);
            } catch (error) {
                console.error('Error fetching activities:', error);
            }
        };

        fetchActivities();
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