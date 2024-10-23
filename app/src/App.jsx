import Topbar from "./components/Topbar";
import AccountSettings from "./pages/AccountSettings";
import AdditionalSettings from "./pages/AdditionalSettings";
import GeneralSettings from "./pages/GeneralSettings";
import PaymentSettings from "./pages/PaymentSettings";
import Subscriptiions from "./pages/Subscriptiions";
import Setting from "./pages/settings";
import "./style/index.scss";
import { Routes, Route, HashRouter } from "react-router-dom";



export default function App() {


  return (
    <HashRouter>
      <div className="acws-container">
        <Topbar />
        <Routes>
          <Route index path="/" element={<Subscriptiions />} />
          <Route path="/settings" element={<Setting />}>
            <Route index element={<GeneralSettings />} />
            <Route path="additional" element={<AdditionalSettings />} />
            <Route path="payment" element={<PaymentSettings />} />
            <Route path="account" element={<AccountSettings />} />
          </Route>
        </Routes>
      </div>
    </HashRouter>
  );
}
