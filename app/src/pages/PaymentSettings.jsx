import React, { useEffect } from "react";
import Toggle from "../components/Switch";
import { PayPal, Stripe } from "../icons/icons";
import axios from "axios";
function PaymentSettings() {

  // const [paymentSettings,setPaymentSettings]={
  //   retryPayments:false,
  //   stripeEnable:false,
  //   paypalEnable:false,
  //   removeTax:false,
  //   acceptManual:false
  // }

  const  handleClick=async(e)=>{
    e.preventDefault()
    console.log('function called');
    
    await axios.post(`${subscriptionPluginData.apiUrl}paymentSettings`,{"msg":"data"});
  }
  return (
    <div className="acws-settings-payment">
      <form action="">

      <div className="acws-settings-paymentSub">
        <p>Retry Failed Payments</p>
        <Toggle/>
      </div>
      <div className="acws-settings-paymentSub">
        <p>Set Automated payment method's</p>
      </div>
      <div className="acws-settings-paymentSub">
        <div className="acws-payment-categorize">
          <div className="acws-strip-div">
            <Stripe />
            <h4>
              Accept all major debit and credit cards as well as local payment
              methods with Stripe
            </h4>
          </div>
          <div className="acws-strip-div">
            <PayPal />
            <h4>
              PayPal's latest, all-in-one checkout solution. Securely accept
              PayPal Digital Payments, credit/debit cards and local payment
              methods.
            </h4>
          </div>
        </div>
      </div>
      <div className="acws-settings-paymentSub">
        <p>Remove tax from Subscription order </p>
        <Toggle />
      </div>
      <div className="acws-settings-paymentSub">
        <p>Accept Manual Payment </p>
        <Toggle />
      </div>
      <div className="acws-settings-paymentSub">
        <p>Manual Renewal Payments (Accept Manual Renewal OR not)</p>
        <Toggle />
      </div>
      <div className="acws-settings-paymentSub">
        <hr className="acws-common-separator" />
      </div>
      <div className="acws-btn-group">
          <button type="submit" onClick={handleClick} className="acws-save-btn">
            Save Changes
          </button>
          <button type="submit" className="acws-save-btn">
            Reset Defaults
          </button>
        </div>
      </form>
    </div>
  );
}

export default PaymentSettings;
