# Magento 2 Layout Debugger
This modules allows the generated page layout to be output in browser for
inspection during development.

## Installation
In your Magento 2 root directory run:  
`composer require pmclain/magento2-layoutdebug`  
`bin/magento setup:upgrade`
`bin/magento deploy:mode:set developer`

## Usage
Append `?xml=true` to any url and the generated layout xml will be returned. The
query string will bypass the FPC, if enabled.

## License
GNU GENERAL PUBLIC LICENSE Version 3