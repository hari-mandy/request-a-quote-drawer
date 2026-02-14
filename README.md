# Clairfi Calculator

A custom wordpress plugin for clairfi project to handle the calculation from the backend api's and registration ui components for the elite access registration.

## Requirments

    1. WordPress 6.0 or higher
    2. PHP 8.0 or higher
    3. Node.js & npm (for development only)
    4. Backend API access (refer to the API documentation for detailed integration)

    ⚠️ Ensure the backend APIs are properly configured before using the calculator and registration features.

## Installation

    1. Download the plugin files.
    2. Upload the plugin folder to the /wp-content/plugins/ directory.
    3. Activate the plugin via the Plugins menu in WordPress.
    4. Open any page or post in the Block Editor.
    4. Insert the “Clairfi Calculator” or “Clairfi Elite Form” block as needed.

## Available Blocks

    1. Clairfi Calculator
        * Displays interactive financial calculations
        * Visualizes results using charts and sliders
    2. Clairfi Elite Form
        * Handles user registration for Elite Access
        * Includes multi-step form validation and secure password handling

## Features

-   Reusable React UI components
-   Chart rendering using react-chartjs-2
-   Customizable range slider powered by react-range
-   API-driven calculations from the backend
-   Fully compatible with the WordPress Block Editor
-   Easy style customization using CSS overrides

## Usage Notes

    1. Blocks are pre-registered — simply drag and drop the Clairfi Calculator or Clairfi Elite Form blocks anywhere in the editor.
    2. Ensure required backend APIs are reachable before publishing the page.

## screenshots

### Backend

#### Using Block

##### calculator Block

![calculator Block](./src/screenshots/calculator-block.png)

##### elite registration Block

![elite registration Block](./src/screenshots/elite-form-block.png)

### Frontend

#### calculator UI

![range slider](./src/screenshots/range-slider.png)
![chart design](./src/screenshots/chart-design.png)

#### Registration UI

![range slider](./src/screenshots/registration-form.png)
