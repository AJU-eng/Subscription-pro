import React from "react";
import { Subscription, Logo, Settings } from "../icons/icons";
import {NavLink } from "react-router-dom";
function Topbar() {


  return (
    <div className="acws-topbar">
      <div className="acws-topbar-div1">
        <div className="acws-logo">
          <Logo />
        </div>
        <div className="acws-title">
          <p className="acws-mainTitle">Woo-Subscription</p>
          <p className="acws-title2">by acowebs</p>
        </div>
      </div>

      <div className="acws-mainTabs">
        <NavLink to={'/'} className={'acws-no-underline'}>
          <div className="acws-Subscription">
            <Subscription />
            <p className="acws-Text">Subscriptions</p>
          </div>
        </NavLink>
        <NavLink to={'/settings'} className={'acws-no-underline'}>
          <div className="acws-settings">
            <Settings />
            <p className="acws-Text">Settings</p>
          </div>
        </NavLink>
      </div>

      <div className="acws-support">
        <div className="acws-support1">
          <p className="acws-contactText">contact support</p>
        </div>
      </div>
    </div>
  );
}

export default Topbar;
