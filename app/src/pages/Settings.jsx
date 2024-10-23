import React from "react";
import Tapbar from "../components/Tapbar";
import { Outlet } from "react-router-dom";

function Setting() {
  return (
    <div>
      <p className="acws-settings-text">Settings</p>
      <Tapbar />
      <Outlet />
    </div>
  );
}

export default Setting;
