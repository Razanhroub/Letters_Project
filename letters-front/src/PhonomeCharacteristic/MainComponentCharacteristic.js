import React, { useState, useEffect } from 'react';
import axios from 'axios';
import swal from 'sweetalert';
import PhonemeCharacteristicForm from './PhonemeCharacteristicForm';

const MainComponentCharacteristic = () => {
    const [currentCharacteristic, setCurrentCharacteristic] = useState(null);

    useEffect(() => {
        const fetchCharacteristics = async () => {
            try {
                console.log('Fetching Characteristics...');
                const response = await axios.get('http://127.0.0.1:8000/api/phoneme-characteristics');
                console.log('Characteristics Fetched:', response.data);
                
                // Set the first characteristic as the current characteristic
                setCurrentCharacteristic(response.data);
            } catch (error) {
                console.error('Error fetching characteristics:', error);
            }
        };

        fetchCharacteristics();
    }, []);

    const handleNext = async (id) => {
        try {
            const response = await axios.get(`http://127.0.0.1:8000/api/phoneme-characteristics/next/${id}`);
            if (response.data) {
                setCurrentCharacteristic(response.data);
                console.log('Next Characteristic Set:', response.data);
            } else {
                swal('هذا هو السجل الأخير.', '', 'info');
                console.log('No more characteristics.');
            }
        } catch (error) {
            swal('هذا هو السجل الأخير.', '', 'info');
        }
    };

    const handlePrev = async (id) => {
        try {
            const response = await axios.get(`http://127.0.0.1:8000/api/phoneme-characteristics/prev/${id}`);
            if (response.data) {
                setCurrentCharacteristic(response.data);
                console.log('Previous Characteristic Set:', response.data);
            } else {
                swal('هذا هو السجل الأول.', '', 'info');
                console.log('No previous characteristics.');
            }
        } catch (error) {
            swal('هذا هو السجل الأول.', '', 'info');
        }
    };

    const handleDelete = async (id) => {
        try {
            await axios.delete(`http://127.0.0.1:8000/api/phoneme-characteristics/${id}`);
            handleNext(id);
        } catch (error) {
            console.error('Error deleting characteristic:', error);
        }
    };

    const handleUpdate = async (id, data) => {
        try {
            await axios.put(`http://127.0.0.1:8000/api/phoneme-characteristics/${id}`, data);
            console.log('Characteristic updated:', data);
        } catch (error) {
            console.error('Error updating characteristic:', error);
        }
    };

    return (
        <div>
            {currentCharacteristic && (
                <PhonemeCharacteristicForm    
                    characteristic={currentCharacteristic}
                    onNext={handleNext}
                    onPrev={handlePrev}
                    handleDelete={handleDelete}
                    handleUpdate={handleUpdate}
                />
            )}
        </div>
    );
};

export default MainComponentCharacteristic;
