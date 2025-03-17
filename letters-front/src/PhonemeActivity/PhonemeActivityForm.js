import React, { useState, useEffect } from 'react';
import Swal from 'sweetalert2';
import axios from 'axios';
import '../main.css';

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

    const isActive = formData.is_active === "1";
    console.log(`isActive: ${isActive}`);

    const handleToggleActive = (e) => {
        setFormData({
            ...formData,
            is_active: e.target.checked ? "1" : "0" // Convert boolean to "1" or "0"
        });
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

    const handleUpdate = async () => {
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
                    // Show success message
                    Swal.fire({
                        title: 'تم التحديث!',
                        text: 'تم تحديث البيانات بنجاح',
                        icon: 'success',
                        confirmButtonText: 'حسنًا'
                    });
                } catch (error) {
                    console.error('Error updating activity:', error);
                    // Show error message
                    Swal.fire({
                        title: 'خطأ!',
                        text: 'حدث خطأ أثناء تحديث البيانات',
                        icon: 'error',
                        confirmButtonText: 'حسنًا'
                    });
                }
            }
        });
    };

    // Check if the character is active (1) or inactive (0)

    return (
        <div className="phoneme-form-container">
            <div className="phoneme-form-background"></div>

            <div className="phoneme-form-header">
                <div className="phoneme-char-wrapper">
                    <div className="phoneme-char-display">{formData.phoneme.char}</div>
                </div>
                <h2 className="phoneme-form-title">بيانات الصوت</h2>
            </div>

            <div className="phoneme-form-content">
                <div className="phoneme-form-group">
                    <label htmlFor="type-input">النوع</label>
                    <input
                        className="phoneme-input rtl-input"
                        name="type"
                        value={formData.type}
                        onChange={handleChange}
                        placeholder="النوع"
                        id="type-input"
                    />
                </div>

                <div className="phoneme-form-group">
                    <label>عامل أم خامل</label>
                    <div className="toggle-switch-container">
                        <div className="toggle-label">خامل</div>
                        <div className="toggle-switch">
                            <input
                                type="checkbox"
                                id="active-toggle"
                                checked={isActive} 
                                onChange={handleToggleActive} // Pass the event directly
                            />

                            <label htmlFor="active-toggle"></label>
                        </div>
                        <div className="toggle-label">عامل</div>
                    </div>
                </div>

                <div className="phoneme-form-group">
                    <label htmlFor="effect-input">التأثير النحوي</label>
                    <textarea
                        className="phoneme-input rtl-input phoneme-textarea"
                        name="grammatical_effect"
                        value={formData.grammatical_effect}
                        onChange={handleChange}
                        placeholder="التأثير النحوي"
                        id="effect-input"
                    ></textarea>
                </div>

                <div className="phoneme-form-group">
                    <label htmlFor="examples-input">مثال</label>
                    <textarea
                        className="phoneme-input rtl-input phoneme-textarea"
                        name="examples"
                        value={formData.examples}
                        onChange={handleChange}
                        placeholder="مثال"
                        id="examples-input"
                    ></textarea>
                </div>
            </div>

            <div className="phoneme-form-actions">
                <div className="phoneme-nav-buttons">
                    <button type="button" className="phoneme-btn phoneme-btn-prev" onClick={handlePrev}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                            <path fillRule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                        </svg>
                        السابق
                    </button>
                    <button type="button" className="phoneme-btn phoneme-btn-next" onClick={handleNext}>
                        التالي
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                            <path fillRule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </button>
                </div>

                <div className="phoneme-action-buttons">
                    <button type="button" className="phoneme-btn phoneme-btn-update" onClick={handleUpdate}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                        تحديث
                    </button>
                    <button type="button" className="phoneme-btn phoneme-btn-delete" onClick={handleDelete}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5.5 0 0 1-1 0V6a.5.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5.5 0 0 0 1 0V6z" />
                            <path fillRule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                        </svg>
                        حذف
                    </button>
                </div>
            </div>
        </div>
    );
};

export default PhonemeActivityForm;