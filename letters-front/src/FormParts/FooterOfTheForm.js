import React from 'react';
import swal from 'sweetalert';

const FooterOfTheForm = ({ handlePrev, handleNext, handleUpdate, handleDelete }) => {
    const handlePrevClick = async () => {
        try {
            await handlePrev();
        } catch (error) {
            swal('هذا هو السجل الأول.', '', 'info');
        }
    };

    const handleNextClick = async () => {
        try {
            await handleNext();
        } catch (error) {
            swal('هذا هو السجل الأخير.', '', 'info');
        }
    };

    const handleUpdateClick = () => {
        swal({
            title: "هل أنت متأكد؟",
            text: "هل تريد تحديث هذا السجل؟",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willUpdate) => {
            if (willUpdate) {
                handleUpdate();
                swal("تم تحديث السجل بنجاح!", {
                    icon: "success",
                });
            } else {
                swal("لم يتم تحديث السجل.");
            }
        });
    };

    const handleDeleteClick = () => {
        swal({
            title: "هل أنت متأكد؟",
            text: "هل تريد حذف هذا السجل؟",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                handleDelete();
                swal("تم حذف السجل بنجاح!", {
                    icon: "success",
                });
            } else {
                swal("لم يتم حذف السجل.");
            }
        });
    };

    return (
        <div className="phoneme-form-actions">
            <div className="phoneme-nav-buttons">
                <button type="button" className="phoneme-btn phoneme-btn-prev" onClick={handlePrevClick}>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                        <path fillRule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    السابق
                </button>
                <button type="button" className="phoneme-btn phoneme-btn-next" onClick={handleNextClick}>
                    التالي
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                        <path fillRule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </button>
            </div>
            
            <div className="phoneme-action-buttons">
                <button type="button" className="phoneme-btn phoneme-btn-update" onClick={handleUpdateClick}>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    تحديث
                </button>
                <button type="button" className="phoneme-btn phoneme-btn-delete" onClick={handleDeleteClick}>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fillRule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                    </svg>
                    حذف
                </button>
            </div>
        </div>
    );
};

export default FooterOfTheForm;