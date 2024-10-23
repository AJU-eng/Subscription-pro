import React from "react";
import { SearchIcon } from "../icons/icons";
import arrowPrev from "../assets/arrow-203.svg";
import arrowDouble from "../assets/arrow-207.svg";
function Subscriptiions() {
  return (
    <>
      <h3 className="acws-sub-title">List of Subscriptions</h3>
      <div className="acws-Sub-main">
        <div className="acws-filteres">
          <select className="acws-select-bulk" name="" id="">
            <option value="">Bulk Actions</option>
            <option value="">Move to Trash</option>
            <option value="">Change status to Active</option>
            <option value="">Change status to Suspend</option>
            <option value="">Change status to Cancel</option>
          </select>

          <div className="acws-apply-button">
            <p>Apply</p>
          </div>
          <select className="acws-select-bulk" name="" id="">
            <option value="">All Dates</option>
          </select>
        </div>
        <div className="acws-pagination">
          <div className="acws-search-icon">
            <SearchIcon />
          </div>
          <input type="text" className="acws-search" />
          <div className="acws-divs">
            <div className="acws-apply-button">
              <p>Search</p>
            </div>
            <div className="acws-prev-div">
              <img src={arrowPrev} className="acws-prev" alt="" />
            </div>
            <div className="acws-prev-div">
              <img src={arrowDouble} className="acws-prev" alt="" />
            </div>
            <div className="acws-page-indicate">
              <p>1 of 0</p>
            </div>
            <div className="acws-prev-div">
              <img src={arrowDouble} className="acws-next" alt="" />
            </div>
          </div>
        </div>
      </div>
      <div>
        <table className="acws-table">
          {/* <div className="acws-separator"> */}
          <tr>
            <th>
              <input type="checkbox" />
            </th>
            <th>Status</th>
            <th>Product</th>
            <th>Subscription</th>
            <th>Recurring</th>
            <th>Last Order Date</th>
            <th>Started</th>
            <th>Next Payment</th>
            <th>Expires</th>
            <th>Orders </th>
          </tr>

          {/* </div> */}

          <tr>
            <td>
              <input type="checkbox" />
            </td>
            <td >
              <div className="acws-active">Active</div>
            </td>
            <td>34-test variable - Small</td>
            <td> #1615 for aco_demo_admin</td>
            <td>₹9.00 / month </td>
            <td>November 20, 2023</td>
            <td>November 20, 2023</td>
            <td>December 20, 2023</td>
            <td>-</td>
            <td>1</td>
          </tr>
        </table>
      </div>
    </>
  );
}

export default Subscriptiions;
