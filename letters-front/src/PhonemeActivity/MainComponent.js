import React, { useState, useEffect } from 'react';
import axios from 'axios';
import PhonemeActivityForm  from './PhonemeActivityForm';

const MainComponent = () => {
    const [currentActivity, setCurrentActivity] = useState(null);

    useEffect(() => {
        const fetchActivities = async () => {
            try {
                console.log('Fetching Activities...');
                const response = await axios.get('http://127.0.0.1:8000/api/phoneme-activities');
                console.log('Activities Fetched:', response.data);
                
                // Set the first activity as the current activity
                setCurrentActivity(response.data);
            } catch (error) {
                console.error('Error fetching activities:', error);
            }
        };

        fetchActivities();
    }, []);

    const handleNext = async () => {
        if (currentActivity) {
            try {
                const response = await axios.get(`http://127.0.0.1:8000/api/phoneme-activities/next/${currentActivity.id}`);
                if (response.data) {
                    setCurrentActivity(response.data);
                    console.log('Next Activity Set:', response.data);
                } else {
                    console.log('No more activities.');
                }
            } catch (error) {
                console.error('Error fetching next activity:', error);
            }
        }
    };

    const handlePrev = async () => {
        if (currentActivity) {
            try {
                const response = await axios.get(`http://127.0.0.1:8000/api/phoneme-activities/prev/${currentActivity.id}`);
                if (response.data) {
                    setCurrentActivity(response.data);
                    console.log('Previous Activity Set:', response.data);
                } else {
                    console.log('No previous activities.');
                }
            } catch (error) {
                console.error('Error fetching previous activity:', error);
            }
        }
    };

    return (
        <div>
            {currentActivity && (
                <PhonemeActivityForm    
                    activity={currentActivity}
                    onNext={handleNext}
                    onPrev={handlePrev}
                />
            )}
        </div>
    );
};

export default MainComponent;