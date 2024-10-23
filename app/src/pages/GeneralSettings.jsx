import React, { useEffect, useState } from "react";
import Toggle from "../components/Switch";
import axios from "axios";

function GeneralSettings() {
  const userType = [
    "Administrator",
    "Editor",
    "Author",
    "Contributor",
    "Subscriber",
    "Customer",
    "Shop manager",
    "Organizer",
    "Vendor",
    "Store Vendor",
  ];

  const [generalSettings, setSettings] = useState({
    enableSubscription: false,
    cartLabel: "",
    orderLabel: "",
    subDefaultRole: "",
    ItemsListPage: "",
    RenwelOrder: {
      oneTimeShipping: false,
      RenewalShipping: false,
      RenewalDiscount: false,
      RenewalCouponDiscount: "",
    },
  });
  useEffect(() => {
    async function getData() {
      try {
        const response = await axios.get(
          `${subscriptionPluginData.apiUrl}getSettings`
        );
        setSettings(response.data.generalSettings);
        console.log(response.data.generalSettings);
      } catch (error) {}
    }
    getData();
  }, []);

  const handleClick = async (e) => {
    e.preventDefault();
    try {
      console.log(generalSettings);

      await axios.post(`${subscriptionPluginData.apiUrl}generalSettings`, {
        generalSettings,
      });
    } catch (error) {}
  };
  return (
    <div className="acws-settings-sub">
      <h2>General Settings</h2>
      <form action="">
        <div className="acws-settings-section">
          <p>Enable Subscription</p>
          <Toggle
            id={"enable"}
            isOn={generalSettings.enableSubscription}
            handleToggle={() =>
              setSettings((prevSettings) => ({
                ...prevSettings,
                enableSubscription: !prevSettings.enableSubscription,
              }))
            }
          />
        </div>

        {generalSettings.enableSubscription && (
          <div>
            <div className="acws-settings-section">
              <p>Add to Cart Label</p>
              <input
                className="acws-settings-input"
                placeholder="Label"
                value={generalSettings.cartLabel}
                onChange={(e) =>
                  setSettings((prevSettings) => ({
                    ...prevSettings,
                    cartLabel: e.target.value,
                  }))
                }
                type="text"
              />
            </div>
            <div className="acws-settings-section">
              <p>Place Order Label </p>
              <input
                className="acws-settings-input"
                placeholder="Label"
                value={generalSettings.orderLabel}
                onChange={(e) =>
                  setSettings((prevSettings) => ({
                    ...prevSettings,
                    orderLabel: e.target.value,
                  }))
                }
                type="text"
              />
            </div>
            <div className="acws-settings-section">
              <p>Subscriber default role</p>
              <select
                className="acws-settings-select"
                onChange={(e) =>
                  setSettings((prevSettings) => ({
                    ...prevSettings,
                    subDefaultRole: e.target.value,
                  }))
                }
                value={generalSettings.subDefaultRole}
                name=""
                id=""
              >
                {userType.map((i) => {
                  return <option value={i}>{i}</option>;
                })}
              </select>
            </div>
            <div className="acws-settings-section">
              <p>Number of items in subscription list page </p>
              <input
                className="acws-settings-input"
                value={generalSettings.ItemsListPage}
                onChange={(e) =>
                  setSettings((prevSettings) => ({
                    ...prevSettings,
                    ItemsListPage: e.target.value,
                  }))
                }
                placeholder="0"
                type="text"
              />
            </div>

            <p className="acws-settings-secondSubText">
              Renewal Order Settings
            </p>
            <hr className="acws-settings-separator" />
            <div className="acws-settings-section">
              <p>One time Shipping</p>
              <Toggle
                isOn={generalSettings.RenwelOrder.oneTimeShipping}
                handleToggle={() =>
                  setSettings((prevSettings) => ({
                    ...prevSettings,
                    RenwelOrder: {
                      ...prevSettings.RenwelOrder,
                      oneTimeShipping:
                        !prevSettings.RenwelOrder.oneTimeShipping,
                    },
                  }))
                }
                id={"oneTime"}
              />
            </div>
            <div className="acws-settings-section">
              <p>
                Charge Shipping cost only during Renewals of Subscriptions when
                subtotal is 0
              </p>
              <Toggle
                isOn={generalSettings.RenwelOrder.RenewalShipping}
                handleToggle={() =>
                  setSettings((prevSettings) => ({
                    ...prevSettings,
                    RenwelOrder: {
                      ...prevSettings.RenwelOrder,
                      RenewalShipping:
                        !prevSettings.RenwelOrder.RenewalShipping,
                    },
                  }))
                }
                id={"renewalShipping"}
              />
            </div>
            <div className="acws-settings-section">
              <p>Apply Coupon code discount in renewal order </p>
              <Toggle
                isOn={generalSettings.RenwelOrder.RenewalDiscount}
                handleToggle={() =>
                  setSettings((prevSettings) => ({
                    ...prevSettings,
                    RenwelOrder: {
                      ...prevSettings.RenwelOrder,
                      RenewalDiscount:
                        !prevSettings.RenwelOrder.RenewalDiscount,
                    },
                  }))
                }
              />
            </div>
            <div className="acws-settings-section">
              <p>Apply coupon code discount in renewal order for </p>
              <select
                className="acws-settings-select"
                value={generalSettings.RenwelOrder.RenewalCouponDiscount}
                onChange={(e) =>
                  setSettings((prevSettings) => ({
                    ...prevSettings,
                    RenwelOrder: {
                      ...prevSettings.RenwelOrder,
                      RenewalCouponDiscount: e.target.value,
                    },
                  }))
                }
                name=""
                id=""
              >
                <option value="All User">All User</option>
                <option value="Include User">Include User</option>
                <option value="Exclude User">Exclude User</option>
                <option value="Include User Role">Include User Role</option>
                <option value="Exclude User Role">Exclude User Role</option>
              </select>
            </div>
          </div>
        )}
        <hr className="acws-settings-separator" />
        <div className="acws-btn-group">
          <button type="submit" className="acws-save-btn" onClick={handleClick}>
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

export default GeneralSettings;
