import React from "react";
import Toggle from "../components/Switch";
function AccountSettings() {
  return (
    <div className="acws-settings-sub">
      <h2>My Account</h2>
      <hr className="acws-common-separator" />
      <div className="acws-settings-section">
        <p>Allow Subscribers to push their subscriptions</p>
        <Toggle />
      </div>
      <div className="acws-settings-section">
        <p>Allow Subscribers to Resubscribe</p>
        <Toggle />
      </div>
      <div className="acws-settings-section">
        <p>Allow Customer to cancel Subscription </p>
        <Toggle />
      </div>
      <div className="acws-settings-section">
        <p>Load billing and shipping address in the subscription details</p>
        <Toggle />
      </div>
      <div className="acws-settings-section">
        <p>Accept Early Renewal Payment</p>
        <Toggle />
      </div>
      <hr className="acws-common-separator" />
      <div className="acws-btn-group">
        <button className="acws-save-btn" >
          Save Changes
        </button>
        <button className="acws-save-btn">Reset Defaults</button>
      </div>
    </div>
  );
}

export default AccountSettings;
