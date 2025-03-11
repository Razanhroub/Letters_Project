import React, { useState, useEffect } from 'react';
import axios from 'axios';
import PhonemeActivityForm  from './PhonemeActivityForm ';

const MainComponent = () => {
    const [activities, setActivities] = useState([]);
    const [currentIndex, setCurrentIndex] = useState(0);

    useEffect(() => {
        fetchActivity(1); // Start with the first activity
    }, []);

    const fetchActivity = async (id) => {
        try {
            const response = await axios.get(`/api/phoneme-activity/${id}`);
            setActivities([response.data]);
        } catch (error) {
            console.error('Error fetching activity:', error);
        }
    };

    const handleNext = async () => {
        try {
            const currentId = activities[currentIndex].id;
            const response = await axios.get(`/api/phoneme-activity/next/${currentId}`);
            setActivities([response.data]);
            setCurrentIndex(0);
        } catch (error) {
            console.error('Error fetching next activity:', error);
        }
    };

    const handlePrev = async () => {
        try {
            const currentId = activities[currentIndex].id;
            const response = await axios.get(`/api/phoneme-activity/prev/${currentId}`);
            setActivities([response.data]);
            setCurrentIndex(0);
        } catch (error) {
            console.error('Error fetching previous activity:', error);
        }
    };

    return (
        <div>
            {activities.length > 0 && (
                <PhonemeActivityForm 
                    activity={activities[currentIndex]}
                    onNext={handleNext}
                    onPrev={handlePrev}
                />
            )}
        </div>
    );
};

export default MainComponent;