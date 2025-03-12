import React, { useState, useEffect } from 'react';
import Swal from 'sweetalert2';
import axios from 'axios';
import './PhonemeActivityForm.css';

const TrashIcon = () => (
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5.5 0 0 1-1 0V6a.5.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5.5 0 0 0 1 0V6z"/>
    <path fillRule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
  </svg>
);

const PhonemeActivityForm = ({ activity, onNext, onPrev }) => {
    const [formData, setFormData] = useState(activity);

    useEffect(() => {
        setFormData(activity);
    }, [activity]);

    const handleChange = (e) => {
        const { name, value } = e.target;
        if (name === 'char') {
            setFormData({
                ...formData,
                phoneme: {
                    ...formData.phoneme,
                    char: value
                }
            });
        } else {
            setFormData({ ...formData, [name]: value });
        }
    };

    const handleNext = async () => {
        try {
            await axios.put(`http://127.0.0.1:8000/api/phoneme-activities/${formData.id}`, formData);
            onNext();
        } catch (error) {
            console.error('Error updating activity:', error);
        }
    };

    const handlePrev = async () => {
        try {
            await axios.put(`http://127.0.0.1:8000/api/phoneme-activities/${formData.id}`, formData);
            onPrev();
        } catch (error) {
            console.error('Error updating activity:', error);
        }
    };

    const handleDelete = () => {
        Swal.fire({
            title: 'هل أنت متأكد؟',
            text: 'هل تريد حذف هذا السجل؟',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'نعم، احذفه!',
            cancelButtonText: 'لا، إلغاء',
            customClass: {
                confirmButton: 'btn-confirm',
                cancelButton: 'btn-cancel'
            },
            buttonsStyling: false
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    await axios.delete(`http://127.0.0.1:8000/api/phoneme-activities/${formData.id}`);
                    onNext();
                } catch (error) {
                    console.error('Error deleting activity:', error);
                }
            }
        });
    };

    const handleUpdate = () => {
        Swal.fire({
            title: 'هل أنت متأكد؟',
            text: 'هل تريد تحديث هذا السجل؟',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'نعم، حدثه!',
            cancelButtonText: 'لا، إلغاء',
            customClass: {
                confirmButton: 'btn-confirm',
                cancelButton: 'btn-cancel'
            },
            buttonsStyling: false
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    await axios.put(`http://127.0.0.1:8000/api/phoneme-activities/${formData.id}`, formData);
                    console.log('Activity updated:', formData);
                } catch (error) {
                    console.error('Error updating activity:', error);
                }
            }
        });
    };

    return (
        <form className="form-container">
            <div className="form-decoration decoration-1"></div>
            <div className="form-decoration decoration-2"></div>
            <h2 className="form-title">البيانات</h2>
            <div className="input-group">
                <input 
                    className="rtl-input"
                    name="type" 
                    value={formData.type} 
                    onChange={handleChange} 
                    placeholder="النوع" 
                    id="type-input"
                />
                <label htmlFor="type-input">النوع</label>
            </div>
            <div className="input-group">
                <input 
                    className="rtl-input"
                    name="is_active" 
                    value={formData.is_active} 
                    onChange={handleChange} 
                    placeholder="عامل أم خامل" 
                    id="active-input"
                />
                <label htmlFor="active-input">عامل أم خامل</label>
            </div>
            <div className="input-group">
                <input 
                    className="rtl-input"
                    name="grammatical_effect" 
                    value={formData.grammatical_effect} 
                    onChange={handleChange} 
                    placeholder="التأثير النحوي" 
                    id="effect-input"
                />
                <label htmlFor="effect-input">التأثير النحوي</label>
            </div>
            <div className="input-group">
                <input 
                    className="rtl-input"
                    name="examples" 
                    value={formData.examples} 
                    onChange={handleChange} 
                    placeholder="مثال" 
                    id="examples-input"
                />
                <label htmlFor="examples-input">مثال</label>
            </div>
            <div className="input-group">
                <input 
                    name="char" 
                    value={formData.phoneme.char} 
                    readOnly
                    placeholder="Char" 
                    id="char-input"
                />
                <label htmlFor="char-input">Character</label>
            </div>
            <div className="form-button-group">
                <button type="button" className="btn-next" onClick={handleNext}>
                    التالي
                </button>
                <button type="button" className="btn-prev" onClick={handlePrev}>
                    السابق
                </button>
                <button type="button" className="btn-update" onClick={handleUpdate}>
                    تحديث
                </button>
                <button type="button" className="btn-delete" onClick={handleDelete}>
                    <TrashIcon /> حذف
                </button>
            </div>
        </form>
    );
};

export default PhonemeActivityForm;