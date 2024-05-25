const puppeteer = require('puppeteer');

async function getYouTubePageHtml(url) {
    const browser = await puppeteer.launch();
    const page = await browser.newPage();

    // Navigate to the YouTube video page
    await page.goto(url, { waitUntil: 'networkidle2' });

    // Get the HTML content after the page is fully loaded
    const htmlContent = await page.content();

    await browser.close();
    return htmlContent;
}

const youtubeUrl = 'https://www.youtube.com/watch?v=Wz3fH8L-DjI';
getYouTubePageHtml(youtubeUrl).then(htmlContent => {
    console.log(htmlContent);
}).catch(error => {
    console.error(`Error fetching the YouTube page: ${error.message}`);
});

