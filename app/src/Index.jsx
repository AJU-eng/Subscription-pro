import React from 'react';
import { render } from '@wordpress/element'; // Correctly import render from @wordpress/element
import App from './App';

const rootElement = document.getElementById('root');
render(<App />, rootElement); // Correctly render the App component
