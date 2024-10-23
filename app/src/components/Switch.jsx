import React from 'react'
import "../style/index.scss"
function Toggle({isOn,onColor,handleToggle,id}) {
    return (
        <div className="acws_switch-container">
        <input
          checked={isOn}
          onClick={handleToggle}
          className={"acws_switch-checkbox "}
          id={`react-switch-new-${id}`}
          type="checkbox"
        />
        <label
          style={{ background: isOn && onColor }}
          className="acws_switch-label"
          htmlFor={`react-switch-new-${id}`}
        >
          <span className={`acws_switch-button`} />
        </label>
      </div>
      )
}

export default Toggle