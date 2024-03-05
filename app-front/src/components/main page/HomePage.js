import Request from '../request/Request';
import React, { useEffect, useState } from 'react';
import SubscriptionPage from '../subscriptions/SubscriptionPage';
import { CssBaseline } from '@mui/material';
import NavBar from './ResponsiveAppBar';
import TitlebarImageList from '../catalog/CatalogList';


export default function HomePage() {

  return (
    <>
      
      <NavBar></NavBar>
      <TitlebarImageList></TitlebarImageList>
      <SubscriptionPage></SubscriptionPage>
      <CssBaseline></CssBaseline>
      <Request></Request>
      
    </>

  );

};


