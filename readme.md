# Hendy Residence Website

This is a web application project for managing the Hendy Residence system. Below is an overview of the setup process, features, and reasoning behind key development decisions.

---

## 1. SCSS Compilation & Documentation

To compile SCSS into CSS using VSCode, follow these steps:

### 🔧 Setup Instructions:

1. Open **VSCode Editor**
2. Browse and install the extension: **Live Sass Compiler**
3. Open **VSCode Settings** and search for `Sass`, or go to `Extensions` → `Live Sass Compiler`
4. Find the `Settings: Formats` section and click **"Edit in settings.json"**
5. Update the `savePath` value to point to your CSS folder (e.g. `/assets/css/`):

```json
"liveSassCompile.settings.formats": [
  {
    "format": "expanded",
    "extensionName": ".css",
    "savePath": "/assets/css/", // change this from null to a valid path
    "savePathReplacementPairs": null
  }
]

6. On the **VSCode Bottom Toolbar** click on 'Watch Sass' to generate the compiled CSS files

## 2. Database Migration
### 1. Make sure Mysql and PHP is installed on your local dev environment
### 2. Create a database with name 'hendy_residences_dev_db'
### 3. Run the migration via thi url: http://localhost/index.php/migrate

## 3. User Registration & Authentication
### 1.Step1
### 2. step2

## 4. User Login 
### 1.Step1
### 2. step2

## 5. Members-Only Page
### 1.Step1
### 2. step2

## 6. Editing & Deleting Users 
### 1.Step1
### 2. step2

## 7. Error Handling & User Feedback  
### 1.Step1
### 2. step2       

## 8. Approach & Reasoning    
### 1.Step1
### 2. step2