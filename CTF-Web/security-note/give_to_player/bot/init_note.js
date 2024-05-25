const puppeteer = require("puppeteer");

async function init_note() {
  const browser = await puppeteer.launch({
    args: ["--no-sandbox"],
    executablePath: "/usr/bin/google-chrome",
    headless: "new",
  });
  let context = await browser.createIncognitoBrowserContext();
  try {
    const authUser = process.env.ADMIN_EMAIL || "admin@admin.admin";
    const authpass = process.env.ADMIN_PW || "pK7pCb0EGbbQ9aRyWWPwnku2RERN";
    console.log(`bot username ${authUser} and password ${authpass}`);

    const appUrl = process.env.URL || 'http://localhost:2808'
    const page = await context.newPage();

    // set key
    await page.goto(appUrl + "/login");
    await page.evaluate((admin_key) => {
        localStorage.setItem('key', admin_key);
        console.log('key', admin_key);
    }, process.env.ADMIN_KEY || "0000000000000000");

    // login
    await page.type('input[name="email"]', authUser);
    await page.type('input[name="password"]', authpass);
    await page.click('button[type="submit"]');
    
    // create flag note
    await page.goto(appUrl + "/home");
    await page.type('input[name="name"]', "flag");
    await page.type('textarea[name="content"]', process.env.FLAG || "flag{chúc may mắn :)}");
    await page.click('button[type="submit"]');

    await page.waitForTimeout(5000);
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

init_note();