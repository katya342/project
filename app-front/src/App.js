import React, { useEffect, useState } from 'react';
import { BrowserRouter as Router, Route, Routes, Navigate, Link } from 'react-router-dom';
import './App.css';
import HomePage from './components/main page/HomePage';
import AccountPage from './components/account/AccountPage';
import UserWorkouts from './components/workouts/UserWorkouts';
import SignIn from './components/Registration&Authentication/Login';
import PlansComp from './components/subscriptions/PlansComp';
import SignUp from './components/Registration&Authentication/SignUp';
import { Box } from '@mui/material';
import Workouts from './components/catalog/WorkoutDetails';

function App() {


  return (
    <>
      <Box className='App'>
        <Router>
          <Routes>
            <Route
              path="/"
              element={<Navigate to="/home" />}
            />
            <Route path="/home" element={<HomePage />} />
            <Route path="/account" element={<AccountPage />} />
            <Route path='/register' element={<SignUp />}></Route>
            <Route
              path='/login'
              element={<SignIn />}
            />
            <Route path='/plans/:planId' element={<PlansComp />}></Route>
            <Route path='/workout/details/:catalogId' element={<Workouts/>}></Route>
            <Route path='/user/workouts' element={<UserWorkouts/>}></Route>
          </Routes>
        </Router>

      </Box>

    </>


  );
}

export default App;
