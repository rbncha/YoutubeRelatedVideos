# Magento 2 Youtube Related Videos 

This is a Magento 2 module. This module can be used to show page title related videos from Youtube between page content and footer section. I have also implemented magento cache to avoid frequent Youtube API query. It stores page wise related Youtube videos in cache until the Magento cache is not cleared. There is a cache timeout which can be configured in admin section in seconds. 

## Compatibility
This module is tested and working with
* Magento 2.4.6 and above (*should work upto 2.4.4 with php 8.0*)
* PHP 8.1 and above

## Installation
Installation is pretty simple. Copy the Rbncha_Main module inside code/ directory of your Magento installation. Run enable module command
> bin/magento module:enable Rbncha_Main

## Configuration
1. Login to Admin
2. Go to **Store > Configuration**. You will see **Rbncha** menu tab.
3. Enable and configure the module at **Rbncha > Youtube API**. 
4. clear the cache
> bin/magento s:s:d -f && bin/magento c:f
> 
![image](https://github.com/user-attachments/assets/7f6f4e1d-a5c3-42b4-8b1d-f0e8b3cc771f)

 ## The default values
 1. **Maximum Result :** 3 videos
 2. **Maximum cache time : ** 86400 seconds

## How it looks in frontend
![image](https://github.com/user-attachments/assets/2e26525e-7f25-4649-b876-5c33fc9b24c3)
![image](https://github.com/user-attachments/assets/f575f807-eefa-496e-a99b-3d93862dcca6)

