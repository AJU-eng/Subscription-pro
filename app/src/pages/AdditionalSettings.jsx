import React from "react";
import Toggle from "../components/Switch";

function AdditionalSettings() {
  return (
    <div className="acws-settings-sub">
      <h2>Addiitional Settings</h2>
      <hr className="acws-common-separator" />

      <p className="acws-settings-secondSubText">Switching</p>
      <p>
        Allow subscribers to switch (upgrade or downgrade) between different
        subscriptions
      </p>
      <div className="acws-settings-section">
        <p>Between Subscription Variations</p>
        <Toggle />
      </div>
      <div className="acws-settings-section">
        <p>Between Grouped Subscriptions </p>
        <Toggle />
      </div>
      <hr className="acws-common-separator" />
      <div >
        <p className="acws-settings-secondSubText">Synchronization</p>
        <p>Align subscription renewal to a specific day of the week, month or year. For example, the first day of the month</p>
        <div className="acws-settings-section">
           <p >Synchronise Renewal</p>
           <Toggle/>
        </div>
      </div>
      <hr className="acws-common-separator" />
       <div>
        <p className="acws-settings-secondSubText">Subscription Limits</p>
        <div  className="acws-settings-section">
          <p>Active Subscription Limit</p>
          <select name="" id="" className="acws-settings-select">
            <option value="">No Limit</option>
            <option value="">One active subscription per product per customer</option>
            <option value="">One active subscription per customer</option>
          </select>
        </div>
        <div  className="acws-settings-section">
          <p>Total subscription allowed</p>
         <input type="number" className="acws-settings-input" />
        </div>
        <div  className="acws-settings-section">
          <p>Number of subscription product allow in cart</p>
         <input type="number" className="acws-settings-input" />
        </div>
       </div>
       <hr className="acws-common-separator"/>
       <div className="acws-btn-group">
          <button className="acws-save-btn" >Save Changes</button>
          <button className="acws-save-btn">Reset Defaults</button>
        </div>
    </div>
  );
}

export default AdditionalSettings;
