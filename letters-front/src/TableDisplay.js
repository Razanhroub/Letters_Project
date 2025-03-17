import React, { useEffect, useState } from 'react';

const TableDisplay = ({ tableName, apiEndpoint }) => {
    const [data, setData] = useState([]);
    const [loading, setLoading] = useState(true);

    // Fetch data on component mount
    useEffect(() => {
        fetch(apiEndpoint)
            .then((response) => response.json())
            .then((data) => {
                setData(data);
                setLoading(false);
            })
            .catch((error) => {
                console.error('Error fetching data:', error);
                setLoading(false);
            });
    }, [apiEndpoint]);

    return (
        <div className="table-container">
            <h2>{tableName}</h2>
            {loading ? (
                <p>Loading...</p>
            ) : (
                <table>
                    <thead>
                        <tr>
                            {data[0] && Object.keys(data[0]).map((key) => (
                                <th key={key}>{key}</th>
                            ))}
                        </tr>
                    </thead>
                    <tbody>
                        {data.map((item, index) => (
                            <tr key={index}>
                                {Object.values(item).map((value, idx) => (
                                    <td key={idx}>{value}</td>
                                ))}
                            </tr>
                        ))}
                    </tbody>
                </table>
            )}
        </div>
    );
};

export default TableDisplay;
