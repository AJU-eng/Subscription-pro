import React ,{useState}from 'react'
import {
    Settings,
    AdditionalSettings,
    PaymentSettings,
    AccountIcon,
    InactivePaymentSettings,
    InactiveAdditionalSettings,
    InactiveSettings,
    InactiveAccountIcon,
  } from "../icons/icons";
  import { NavLink } from "react-router-dom";
function Tapbar() {
    const [accountActive, setAccountActive] = useState(false);
    const [paymentActive, setPaymentActive] = useState(false);
    const [generalActive, setGeneralActive] = useState(true);
    const [AdditionalActive, setAdditionalActive] = useState(false);
  return (
    <div className="acws-settings-nav">
        <NavLink
        
          onClick={() => {
            setGeneralActive(true);
            setAdditionalActive(false);
            setPaymentActive(false);
            setAccountActive(false);
          }}
          className="acws-links"
          to={'/settings'}
        >
          <div className={`${generalActive?"acws-settings-component-active":"acws-settings-component"}`} aria-activedescendant="">
          {generalActive?<Settings />:<InactiveSettings/>} 
            <p>General Settings</p>
          </div>
        </NavLink>
        <NavLink
        to={'additional'}
          onClick={() => {
            setGeneralActive(false);
            setAdditionalActive(true);
            setPaymentActive(false);
            setAccountActive(false);
          }}
          className="acws-links"
        >
          <div className={`${AdditionalActive?"acws-settings-component-active":"acws-settings-component"}`}>
          {AdditionalActive?<AdditionalSettings />:<InactiveAdditionalSettings/>} 
            <p>Additional Settings</p>
          </div>
        </NavLink>
        <NavLink
        to={'payment'}
          onClick={() => {
            setGeneralActive(false);
            setAdditionalActive(false);
            setPaymentActive(true);
            setAccountActive(false);
          }}
          className="acws-links"
        >
          <div className={`${paymentActive?"acws-settings-component-active":"acws-settings-component"}`}>
           {paymentActive?<PaymentSettings />:<InactivePaymentSettings/>} 
            <p>Payment Settings</p>
          </div>
        </NavLink>
        <NavLink
        to={'account'}
          onClick={() => {
            setGeneralActive(false);
            setAdditionalActive(false);
            setPaymentActive(false);
            setAccountActive(true);
          }}
          className="acws-links"
        >
          <div className={`${accountActive?"acws-settings-component-active":"acws-settings-component"}`}>
          {accountActive?<AccountIcon />:<InactiveAccountIcon/>} 
            <p>My Account</p>
          </div>
        </NavLink>
      </div>
  )
}

export default Tapbar