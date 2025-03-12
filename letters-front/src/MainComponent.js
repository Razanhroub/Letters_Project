import React, { useState, useEffect } from 'react';
import axios from 'axios';

const MainComponent = () => {
    const [activities, setActivities] = useState([]);
    const [currentIndex, setCurrentIndex] = useState(0);

    useEffect(() => {
        const fetchActivities = async () => {
            try {
                console.log('Fetching Activities...');
                const response = await axios.get('http://127.0.0.1:8000/api/phoneme-activities');
                console.log('Activities Fetched:', response.data);
                
                // Ensure activities is always an array
                setActivities(Array.isArray(response.data) ? response.data : [response.data]);
            } catch (error) {
                console.error('Error fetching activities:', error);
            }
        };

        fetchActivities();
    }, []);

    useEffect(() => {
        console.log('Activities State Updated:', activities); // Log after state is updated
    }, [activities]);

    const handleNext = () => {
        if (currentIndex < activities.length - 1) {
            setCurrentIndex(currentIndex + 1);
        } else {
            console.log("No more activities.");
        }
    };

    const handlePrev = () => {
        if (currentIndex > 0) {
            setCurrentIndex(currentIndex - 1);
        } else {
            console.log("No previous activities.");
        }
    };

    return (
        <div>
            {activities.length > 0 ? (
                <div>
                    <h1>{activities[currentIndex]?.type}</h1> {/* Safely access `type` */}
                    <button onClick={handleNext}>Next</button>
                    <button onClick={handlePrev}>Previous</button>
                </div>
            ) : (
                <p>Loading activities...</p>
            )}
        </div>
    );
};

export default MainComponent;
