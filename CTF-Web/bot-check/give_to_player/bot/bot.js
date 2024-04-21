const puppeteer = require("puppeteer");

async function visit(url) {
	const browser = await puppeteer.launch({
		args: ["--no-sandbox"],
		executablePath: "/usr/bin/google-chrome",
		headless: "new",
	});
	let context = await browser.createIncognitoBrowserContext();
	try {
		console.log(`visit url: ${url}`);

		const page = await context.newPage();

		// visit provided url
		await page.goto(url, {
			waitUntil: 'networkidle2',
			timeout: 10000
		});

		await page.waitForTimeout(10000);
		await browser.close();
	} catch (error) {
		console.error("Error:", error);
	}

	try {
		await browser.close();
		console.log("Browser Closed");
	} catch (e) {
		console.log(e);
	}
}

module.exports = { visit };
