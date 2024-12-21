import React from 'react'
import ReactDOM from 'react-dom/client';
import 'bootstrap/dist/css/bootstrap.css'
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';

import LayoutPublic from './layouts/LayoutPublic';
import LayoutAdmin from './layouts/LayoutAdmin';
import LayoutClient from './layouts/LayoutClient';

//PUBLIC
import PageHome from './pagepublic/PageHome';
import ProtectedRoutes from './pageauth/ProtectedRoutes';

//AUTH
import Login from './pageauth/Login';
import Register from './pageauth/Register';
import PanelAdmin from './pageadmin/PanelAdmin';
import PanelClient from './pageclient/PanelClient';

import UserAll from './pageadmin/UserAll';
import UserUpdate from './pageadmin/UserUpdate';
import CategoryAll from './pageadmin/CategoryAll';
import CategoryStore from './pageadmin/CategoryStore';
import CategoryUpdate from './pageadmin/CategoryUpdate';
import CompanyAll from './pageadmin/CompanyAll';

const App = () => {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<LayoutPublic/>} >
          <Route index element={<PageHome/>} />
          <Route path='/login' element={<Login/>} />
          <Route path='/register' element={<Register/>} />
        </Route>
        <Route element={<ProtectedRoutes/>} >
          <Route path="/admin" element={<LayoutAdmin/>} >
            <Route index element={<PanelAdmin/>} />
            <Route path='user' element={<UserAll/>}/>
            <Route path='user/edit/:id' element={<UserUpdate/>}/>
            <Route path='category' element={<CategoryAll/>}/>
            <Route path='category/create' element={<CategoryStore/>}/>
            <Route path='category/edit/:id' element={<CategoryUpdate/>}/>
            <Route path='company' element={<CompanyAll/>}/>
          </Route>
          <Route path ="/client" element={<LayoutClient/>} >
            <Route index element={<PageHome/>} />
            <Route index element={<PanelClient/>} />
          </Route>
        </Route>
      </Routes>
    </Router>
  )
}

export default App

if (document.getElementById('root')) {
  const Index = ReactDOM.createRoot(document.getElementById("root"));

  Index.render(
      <React.StrictMode>
          <App/>
      </React.StrictMode>
  )
}