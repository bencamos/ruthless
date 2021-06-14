const puppeteer = require('puppeteer-extra')
var fs = require("fs");
var path = require("path");
var util = require("util");
const solve = require('./solve.js')
const readFile = util.promisify(fs.readFile);
const pluginStealth = require('puppeteer-extra-plugin-stealth')
var codeFile;
puppeteer.use(pluginStealth());
(async () => {
	try {
		const browser = await puppeteer.launch({
			headless: false,
			args: [
        '--disable-web-security',
				'--allow-external-pages',
				'--allow-third-party-modules',
				'--data-reduction-proxy-http-proxies',
				'--no-sandbox'
			]
		})
		const page = await browser.newPage()
    await page.setBypassCSP(true);
		await page.goto('https://recaptcha-demo.appspot.com/recaptcha-v2-checkbox.php', { waitUntil: 'networkidle2' })
		await page.setUserAgent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.131 Safari/537.36")
		await page.waitForTimeout();
    await page.evaluate(_ => {
    function simulate(element, eventName)
    {
      console.log(element);
      var options = extend(defaultOptions, arguments[2] || {});
      var oEvent, eventType = null;

      for (var name in eventMatchers)
      {
          if (eventMatchers[name].test(eventName)) { eventType = name; break; }
      }

      if (!eventType)
          throw new SyntaxError('Only HTMLEvents and MouseEvents interfaces are supported');

      if (document.createEvent)
      {
          oEvent = document.createEvent(eventType);
          if (eventType == 'HTMLEvents')
          {
              oEvent.initEvent(eventName, options.bubbles, options.cancelable);
          }
          else
          {
              oEvent.initMouseEvent(eventName, options.bubbles, options.cancelable, document.defaultView,
              options.button, options.pointerX, options.pointerY, options.pointerX, options.pointerY,
              options.ctrlKey, options.altKey, options.shiftKey, options.metaKey, options.button, element);
          }
          element.dispatchEvent(oEvent);
      }
      else
      {
          options.clientX = options.pointerX;
          options.clientY = options.pointerY;
          var evt = document.createEventObject();
          oEvent = extend(evt, options);
          element.fireEvent('on' + eventName, oEvent);
      }
      return element;
    }

    function extend(destination, source) {
      for (var property in source)
        destination[property] = source[property];
      return destination;
    }

    var eventMatchers = {
      'HTMLEvents': /^(?:load|unload|abort|error|select|change|submit|reset|focus|blur|resize|scroll)$/,
      'MouseEvents': /^(?:click|dblclick|mouse(?:down|up|over|move|out))$/
    }
    var defaultOptions = {
      pointerX: 0,
      pointerY: 0,
      button: 0,
      ctrlKey: false,
      altKey: false,
      shiftKey: false,
      metaKey: false,
      bubbles: true,
      cancelable: true
    }

    // Click just outside of the box in the "region"
    var iarray = document.getElementsByTagName("iframe")
    var iframe = iarray[Object.keys(iarray)[0]];
    iframe.src = iframe.src;
    iframe.setAttribute("id", "fuckyou");
    console.log(iframe.contentWindow)
    simulate(document.getElementById("rc-anchor-container"), "click");
    });
    //codeFile = fs.readFileSync('captcha.js', 'utf8');
    //await page.evaluate(codeFile)
		//await browser.close()
	} catch (err) {
		console.log(`'Puppeteer Error Detencted -> ${err}'`)
	}
})()