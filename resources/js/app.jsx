import React from 'react';
import ReactDOM from 'react-dom/client';
import AdminDashboard from './components/AdminDashboard.jsx';

if (document.getElementById('react-root')) {
    ReactDOM.createRoot(document.getElementById('react-root')).render(
        <React.StrictMode>
            <AdminDashboard />
        </React.StrictMode>
    );
}
