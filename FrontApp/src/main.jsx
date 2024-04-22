import React from 'react'
import ReactDOM from 'react-dom/client'
import Router from './Router.jsx'
import './assets/styles/ad.css'
import './assets/styles/dashboard.css'
import './assets/styles/general.css'
import './assets/styles/record.css'
import './assets/styles/register.css'
import './assets/styles/usermanage.css'

ReactDOM.createRoot(document.getElementById('root')).render(
  <React.StrictMode>
    <Router />
  </React.StrictMode>,
)