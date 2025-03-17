import React, { useState, useEffect } from 'react';
import '../main.css'; // Ensure this path is correct
import HeaderOfTheForm from '../FormParts/HeaderOfTheForm';
import FooterOfTheForm from '../FormParts/FooterOfTheForm';

const PhonemeCharacteristicForm = ({ characteristic, onNext, onPrev, handleDelete, handleUpdate }) => {
    const [formData, setFormData] = useState(characteristic);
    console.log(formData);

    useEffect(() => {
        setFormData(characteristic);
    }, [characteristic]);

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData({ ...formData, [name]: value });
    };

    return (
        <div className="phoneme-form-container">
            <HeaderOfTheForm title="بيانات الخصائص الصوتية" char={formData.phoneme ? formData.phoneme.char : ''} />
            
            <div className="phoneme-form-content">
                <div className="phoneme-form-group">
                    <label htmlFor="position-input">الموضع</label>
                    <select 
                        className="phoneme-input rtl-input select_drop"
                        name="position" 
                        value={formData.position} 
                        onChange={handleChange} 
                        id="position-input"
                    >
                        <option value="beginning">البداية</option>
                        <option value="middle">الوسط</option>
                        <option value="end">النهاية</option>
                    </select>
                </div>
                
                <div className="phoneme-form-group">
                    <label htmlFor="place_of_articulation-input">مكان النطق</label>
                    <input 
                        className="phoneme-input rtl-input"
                        name="place_of_articulation" 
                        value={formData.place_of_articulation} 
                        onChange={handleChange} 
                        placeholder="مكان النطق" 
                        id="place_of_articulation-input"
                    />
                </div>

                <div className="phoneme-form-group">
                    <label htmlFor="manner_of_articulation-input">طريقة النطق</label>
                    <input 
                        className="phoneme-input rtl-input"
                        name="manner_of_articulation" 
                        value={formData.manner_of_articulation} 
                        onChange={handleChange} 
                        placeholder="طريقة النطق" 
                        id="manner_of_articulation-input"
                    />
                </div>

                <div className="phoneme-form-group">
                    <label htmlFor="voiced-input">مجهور أم مهموس</label>
                    <select 
                        className="phoneme-input rtl-input select_drop"
                        name="voiced" 
                        value={formData.voiced} 
                        onChange={handleChange} 
                        id="voiced-input"
                    >
                        <option value="0">مهموس</option>
                        <option value="1">مجهور</option>
                    </select>
                </div>

                <div className="phoneme-form-group">
                    <label htmlFor="emphasis-input">مفخم أم مرقق</label>
                    <select 
                        className="phoneme-input rtl-input select_drop"
                        name="emphasis" 
                        value={formData.emphasis} 
                        onChange={handleChange} 
                        id="emphasis-input"
                    >
                        <option value="0">مرقق</option>
                        <option value="1">مفخم</option>
                    </select>
                </div>

                <div className="phoneme-form-group">
                    <label htmlFor="duration-input">المدة/الطول</label>
                    <input 
                        className="phoneme-input rtl-input"
                        name="duration" 
                        value={formData.duration} 
                        onChange={handleChange} 
                        placeholder="المدة/الطول" 
                        id="duration-input"
                    />
                </div>

                <div className="phoneme-form-group">
                    <label htmlFor="pitch-input">النغمة</label>
                    <input 
                        className="phoneme-input rtl-input"
                        name="pitch" 
                        value={formData.pitch} 
                        onChange={handleChange} 
                        placeholder="النغمة" 
                        id="pitch-input"
                    />
                </div>

                <div className="phoneme-form-group">
                    <label htmlFor="independent_or_connected-input">مستقل أم مرتبط بالنطق</label>
                    <input 
                        className="phoneme-input rtl-input"
                        name="independent_or_connected" 
                        value={formData.independent_or_connected} 
                        onChange={handleChange} 
                        placeholder="مستقل أم مرتبط بالنطق" 
                        id="independent_or_connected-input"
                    />
                </div>

                <div className="phoneme-form-group">
                    <label htmlFor="pressure_level-input">الضغط الصوتي</label>
                    <input 
                        className="phoneme-input rtl-input"
                        name="pressure_level" 
                        value={formData.pressure_level} 
                        onChange={handleChange} 
                        placeholder="الضغط الصوتي" 
                        id="pressure_level-input"
                    />
                </div>

                <div className="phoneme-form-group">
                    <label htmlFor="resonance_frequency-input">التردد الصوتي</label>
                    <input 
                        className="phoneme-input rtl-input"
                        name="resonance_frequency" 
                        value={formData.resonance_frequency} 
                        onChange={handleChange} 
                        placeholder="التردد الصوتي" 
                        id="resonance_frequency-input"
                    />
                </div>

                <div className="phoneme-form-group">
                    <label htmlFor="force_and_depth-input">القوة والعمق</label>
                    <input 
                        className="phoneme-input rtl-input"
                        name="force_and_depth" 
                        value={formData.force_and_depth} 
                        onChange={handleChange} 
                        placeholder="القوة والعمق" 
                        id="force_and_depth-input"
                    />
                </div>

                <div className="phoneme-form-group">
                    <label htmlFor="phonetic_influence-input">التأثير الصوتي</label>
                    <input 
                        className="phoneme-input rtl-input"
                        name="phonetic_influence" 
                        value={formData.phonetic_influence} 
                        onChange={handleChange} 
                        placeholder="التأثير الصوتي" 
                        id="phonetic_influence-input"
                    />
                </div>

                <div className="phoneme-form-group">
                    <label htmlFor="extra_or_original-input">زائد أم أصلي</label>
                    <input 
                        className="phoneme-input rtl-input"
                        name="extra_or_original" 
                        value={formData.extra_or_original} 
                        onChange={handleChange} 
                        placeholder="زائد أم أصلي" 
                        id="extra_or_original-input"
                    />
                </div>

                <div className="phoneme-form-group">
                    <label htmlFor="consonant_or_vowel-input">حرف صحيح أم معتل</label>
                    <input 
                        className="phoneme-input rtl-input"
                        name="consonant_or_vowel" 
                        value={formData.consonant_or_vowel} 
                        onChange={handleChange} 
                        placeholder="حرف صحيح أم معتل" 
                        id="consonant_or_vowel-input"
                    />
                </div>

                <div className="phoneme-form-group">
                    <label htmlFor="articulation_influence-input">تأثير النطق</label>
                    <input 
                        className="phoneme-input rtl-input"
                        name="articulation_influence" 
                        value={formData.articulation_influence} 
                        onChange={handleChange} 
                        placeholder="تأثير النطق" 
                        id="articulation_influence-input"
                    />
                </div>
            </div>
            
            <FooterOfTheForm 
                handlePrev={() => onPrev(formData.id)} 
                handleNext={() => onNext(formData.id)} 
                handleUpdate={() => handleUpdate(formData.id, formData)} 
                handleDelete={() => handleDelete(formData.id)} 
            />
        </div>
    );
};

export default PhonemeCharacteristicForm;