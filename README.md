# SolarSizerCalculator

A web application to help users calculate the optimal size and number of solar panels based on daily energy consumption and location.

## Project Overview

Solar Sizer Calculator is an intuitive tool designed to help homeowners and solar enthusiasts determine the optimal size and number of solar panels required based on their daily energy consumption and location. By entering essential data such as energy usage, solar panel wattage, and average sunlight hours, users can quickly estimate their solar requirements and make informed decisions about their solar energy investments. The application aims to promote sustainable energy solutions and empower users to optimize their solar power systems efficiently.

## Key Features

### User Inputs

- __Daily Energy Consumption__: Users input the average daily energy usage in kilowatt-hours (kWh), derived from a list of household appliances.
- __Appliance Details__: For each appliance, users provide:
> - Power Rating: The wattage of the appliance (e.g., 1500W).
> - Usage Hours: The average daily hours the appliance is used.
> - Number of Units: The quantity of that appliance in the household.
> - Category: Classification of the appliance (e.g., heating, cooling, lighting, etc.).
- __Solar Panel Output__: The wattage of a single solar panel (e.g., 300W).
- __Average Sunlight Hours__: The average number of peak sunlight hours per day in the user’s location.

### Calculation Logic

- The application retrieves the appliance data and user inputs.
- It calculates the daily energy consumption based on the appliance details.
- It determines the solar panel output using the provided data.
- It calculates the number of panels needed by dividing the daily energy consumption by the panel output.

### Settings Configuration

- Users can configure their energy cost rating (e.g., $0.12 per kWh), currency preferences, dark mode toggle, and location settings.
- The app uses the location to obtain peak sunlight hours through a third-party API, ensuring accurate solar panel power production calculations.

## Output Display

- The results are presented clearly, showing:
> - The total wattage required.
> - The number of solar panels needed.
> - Additional information such as total system size, potential energy production, and estimated cost savings based on the configured energy cost rating.

## Technologies Used

- __Backend__: Laravel
- __Frontend__: Vue.js 3
- __State Management__: Pinia
- __Styling__: Tailwind CSS
- __Database__: MySQL
- __Build Tool__: Vite
- __HTTP Client__: Axios
- __Version Control__: Git, GitHub

## Getting Started

### Prerequisites

- PHP >= 8.2
- Composer
- Node.js and npm
- MySQL

### Installation Instructions

1. Clone the repository:
```bash
git clone https://github.com/medelm1/solar-sizer-calculator
cd solar-sizer-calculator
```

2. Install Backend Dependencies:
```bash
composer install
```

3. Set Up Environment:
Copy `.env.example` to `.env` and update the database configuration and other necessary settings.
```bash
cp .env.example .env
```

4. Generate Application Key:
```bash
php artisan key:generate
```

5. Run Migrations:
```bash
php artisan migrate
```

6. Seed the Database
```bash
php artisan db:seed --class=SettingsSeeder
```

7. Install Frontend Dependencies:
```bash
npm install
```

8. Run the Development Server:
```bash
npm run dev
```

9. Start the Backend Server:
```bash
php artisan serve
```

Now your application should be running at `http://localhost:8000`.

## Contributing

Contributions are welcome! If you would like to contribute to the project, please follow these steps:

1. Fork the repository.

2. Create a new branch for your feature or bug fix:
```bash
git checkout -b feature/my-feature
```
3. Make your changes and commit them:
```bash
git commit -m "Add my feature"
```
4. Push to the branch:
```bash
git push origin feature/my-feature
```
5. Open a Pull Request and describe your changes.
```bash
Thank you for contributing!