# Apply the content brief — implementation plan

**Source copy:** [Bansal Lawyers Website content](https://docs.google.com/document/d/16jk3p8lU5p88vBDjzp6US4AIKRuvoGuRzRrI9XVX6T4/edit?usp=sharing)  
**Live site reviewed:** 27 September 2026, [bansallawyers.com.au](https://www.bansallawyers.com.au/)  
**Naming decision:** use the SEO names in this file (titles and H1s below). Keep the current URL paths.

The homepage is hardcoded in `resources/views/index.blade.php`. The five practice hubs are CMS HTML in `cms_pages.content`, rendered by `resources/views/practice_area.blade.php`. Their `<title>` tags are then overwritten in `HomeController::applySeoOverrides()`, so a CMS-only edit will not change the title.

---

## SEO names to publish

Use these strings. Do not shorten them further and do not swap in “Migration Law”.

| Page | URL (unchanged) | `<title>` | H1 |
|------|-----------------|-----------|----|
| Home | `/` | `Lawyers in Melbourne \| Bansal Lawyers` | `Lawyers in Melbourne` |
| Immigration | `/migration-law` | `Immigration Lawyers Melbourne \| Bansal Lawyers` | `Immigration Lawyers in Melbourne` |
| Family | `/family-law` | `Family Lawyers Melbourne \| Divorce & Parenting` | `Family Lawyers in Melbourne` |
| Criminal | `/criminal-law` | `Criminal Lawyers Melbourne \| Criminal Defence` | `Criminal Lawyers in Melbourne` |
| Commercial | `/commercial-law` | `Commercial Lawyers Melbourne \| Contracts & Disputes` | `Commercial Lawyers in Melbourne` |
| Property | `/property-law` | `Property Lawyers Melbourne \| Leases & Contracts` | `Property Lawyers in Melbourne` |
| Civil (new) | `/civil-law` | `Civil Lawyers Melbourne \| Disputes & Notices` | `Civil Lawyers in Melbourne` |

Homepage subheading, under the H1: `Immigration, family, criminal, commercial, property and civil law`.

Homepage meta description (also Open Graph and Twitter):

`Bansal Lawyers is a Melbourne law firm helping clients with immigration, family, criminal, commercial, property and civil law matters. Book a consultation today.`

Practice meta descriptions, from the brief:

| Page | Meta description |
|------|------------------|
| Immigration | `Bansal Lawyers helps clients with visa applications, refusals, cancellations, ART appeals, partner visas, student visas, skilled migration and citizenship matters.` |
| Family | `Bansal Lawyers assists with divorce, separation, parenting matters, child custody, property settlement, consent orders, family violence and intervention orders.` |
| Criminal | `Bansal Lawyers assists with criminal charges, traffic offences, assault matters, theft, fraud, drug offences, bail applications and court representation.` |
| Commercial | `Bansal Lawyers assists with business contracts, commercial agreements, loan agreements, shareholder matters, business transactions, disputes and debt recovery.` |
| Property | `Bansal Lawyers assists with property contract review, buying and selling property, leases, conveyancing-related support, settlement issues and property disputes.` |
| Civil | `Bansal Lawyers assists with civil disputes, legal notices, contract disputes, debt disputes, negotiation, document preparation and court-related processes.` |

Card and footer labels (short form of the same names): Immigration Lawyers, Family Lawyers, Criminal Lawyers, Commercial Lawyers, Property Lawyers, Civil Lawyers. The word “Melbourne” stays in the title and H1, where it does the SEO work.

`/immigration-law` already 301s to `/migration-law`. Leave that redirect. Do not add `/immigration-lawyers-melbourne/` as a second indexable page.

---

## What is wrong on the live site

These are the gaps this plan closes. Child pages (divorce, visa refusals, ART, assault, traffic, conveyancing, caveats, and the rest) stay as they are. Hubs link down to them.

**Homepage** (`/`)

- Title is `Immigration & Family Lawyers Melbourne | Bansal Lawyers`.
- H1 is the logo words `Bansal Lawyers`. The visible headline is `There is no legal puzzle that we can't solve`.
- “Why choose” calls the firm “the best immigration lawyer in Melbourne” and says “we fight passionately”.
- Practice cards say Family Law, Migration Law, Criminal Law, Commercial Law, Property Law, then a sixth card to `/practice-areas`. No civil law, no FAQs, no process section.
- Keep, below the new sections: testimonials, blog, phone `1300 226 725`, email, Collins St address, enquiry form.

**Practice hubs**

- Body copy is CMS content. Immigration still says “Best Immigration Lawyers”, “AAT / ART”, and lists visa subclasses. Family copy is a general essay on Australian family law, including Western Australia, with grammar errors (“state lawys”, “sepration”) and “best lawyers in Australia”.
- `applySeoOverrides()` already sets short titles for family, migration, and criminal. Commercial and property have a title override and no description override. Replace all five with the table above.
- `practice_area.blade.php` prints **Related migration topics** (ART, visa refusals, Federal Court) on every hub, including family and property. The sidebar form `source` is hardcoded to `property-law`, and its subtitle is still `There's No Legal Puzzle, We Can't Solve.`

**Practice areas index** (`/practice-areas`)

- Intro is ungrammatical: “If you are looking for expert lawyers consultation in Melbourne?”
- Commercial card lists business formation, corporate governance, and intellectual property, which the brief does not offer.
- Stats block claims `500+` cases, `15+` years, `98%` satisfaction, and `24/7` support. Those figures are not in the brief. Remove them in this pass.

**Footer** (`resources/views/Elements/Frontend/footer.blade.php`)

- Practice list says “Migration Law” and omits civil law. Description says “Melbourne and beyond”.

---

## Phase 1 — Homepage

File: `resources/views/index.blade.php`  
Also: the `LegalService` description in `resources/views/layouts/frontend.blade.php` (the homepage branch). Set it to the new meta description plus `Level 8/278 Collins St`.

Hero card is `max-width: 400px` with the H1 at `3rem`. The H1 must stay `Lawyers in Melbourne`. Put the practice list in the subheading, not the H1.

Replace the top of the page, in this order:

1. **Hero.** H1 and subheading from the table. Two sentences from the brief (“Bansal Lawyers is a Melbourne-based law firm…” and “We explain your options in plain language…”). Buttons: `Book a Consultation` → `/book-an-appointment`, `Speak With Our Legal Team` → `tel:1300226725`.
2. **Trust.** Heading `Legal Help That Starts With Clear Advice`. Brief paragraphs, plus one line: Level 8, 278 Collins St, Melbourne, and 1300 226 725. Link “our team” to `/about`.
3. **Services.** Heading `Our Legal Services`. Six cards once civil exists; until then, five cards and a text link to `/practice-areas`. Card titles use the short SEO names. Card blurbs are the brief’s card paragraphs. Each card links to the hub URL in the table.
4. **Why clients choose.** Heading `Why Clients Choose Bansal Lawyers`. Replace the three cards (Your Success is Our Mission, We Speak Your Language, Proven Track Record) with the brief’s paragraph and six points.
5. **Process.** Heading `How the Process Works`. Four steps from the brief.
6. **Urgent CTA.** Heading `Need Legal Advice Before Taking the Next Step?` Button `Book a Consultation` → `/book-an-appointment`.
7. **FAQ.** Six questions from the brief. Immigration answer links to `/migration-law`, family to `/family-law`, and the booking answer to `/book-an-appointment`. Add `FAQPage` JSON-LD that matches the visible questions word for word.
8. **Unchanged after that:** testimonials, blog, contact block.

Skip the brief’s “Who we help” block. It lists everyone and does not add a keyword the H1 does not already cover.

Also update in the same file: `<title>`, meta description, `og:title`, `og:description`, `twitter:title`, `twitter:description`.

Search the homepage for these strings and remove them: `no legal puzzle`, `best immigration lawyer`, `fight passionately`, `Proven Track Record`.

---

## Phase 2 — Practice hub template

File: `resources/views/practice_area.blade.php`

Do this before pasting new CMS HTML, so the new headings are not followed by the wrong related links.

- [ ] Show **Related migration topics** only when `$type == 'migration-law'`. Rename the heading to `Related immigration matters`.
- [ ] Family related links stay: `/divorce`, `/child-custody`, `/property-settlement`. Add `/family-violence` and `/divorce-lawyers-melbourne`.
- [ ] Add the same sidebar block for criminal: `/assault-charges`, `/traffic-offences`, `/drink-driving-offences`, `/intervention-orders`.
- [ ] Commercial: add `/loan-agreement` beside the three links already there.
- [ ] Property: `/conveyancing`, `/building-and-construction-disputes`, `/caveats-disputes-and-removal`.
- [ ] Set the contact form `source` from `$type` (`migration-law`, `family-law`, and so on), not `'property-law'`.
- [ ] Replace the form subtitle `There's No Legal Puzzle, We Can't Solve.` with `Book a consultation with our Melbourne lawyers.`

The template already builds the on-page contents list from `h2` and `h3`. New CMS HTML must use `h2` for the brief’s section headings. The page H1 is the hero in this template (`{{ $pagedata->title }}`), so the CMS body must not contain a second `h1`.

---

## Phase 3 — Titles in code

File: `app/Http/Controllers/HomeController.php`, method `applySeoOverrides()`.

Replace the `family-law`, `migration-law`, `criminal-law`, `commercial-law`, and `property-law` entries with the title and description in the table. Add `civil-law` in the same array when that page exists.

`practice_area.blade.php` canonical is `https://www.bansallawyers.com.au/{{ $pagedata->slug }}`. After the override, slug is the route slug (`migration-law`, not a new keyword slug). Leave that as is.

Open Graph and Twitter on that template already read `meta_title` and `meta_description`, so they follow the override.

---

## Phase 4 — Replace hub body copy

Update `cms_pages` for slugs `migration-law`, `family-law`, `criminal-law`, `commercial-law`, `property-law`.

Set `title` to the H1 in the table (the hero prints `title`). Set `content` to the brief’s sections as HTML: intro paragraphs, then `h2` sections, `ul` matter lists, and an FAQ block at the end. Do not put the SEO label or a second H1 in `content`.

Copy rules while pasting the brief:

- Keep Australian spelling already in the brief (defence, licence).
- Say ART, not AAT.
- On immigration, link: visa refusals → `/visa-refusals-visa-cancellation`, ART appeals → `/art-application`, Federal Court → `/federal-court-application`.
- On family, link divorce → `/divorce` and parenting → `/child-custody` and property settlement → `/property-settlement`. Keep this page as the overview. `/divorce-lawyers-melbourne` remains the long divorce page.
- On criminal, link assault, traffic, drink driving, and intervention orders to the existing child URLs.
- On commercial, link contracts → `/contracts-or-business-agreements`, loan agreements → `/loan-agreement`, business sale → `/leasing-or-selling-a-business`.
- On property, keep the phrase “conveyancing-related legal support” and link it to `/conveyancing`. Also link caveats and building disputes.
- Immigration page: delete “across Australia” unless the homepage is changed to say the same. Use “in Melbourne”.
- Civil matters that are really commercial or property: on the civil page, link those readers to `/commercial-law` and `/property-law`.
- Before the civil page is published, delete or rewrite “Compensation-related matters”. As written it reads as personal injury.
- Two buttons in the hero area and again above the FAQ: `Book a Consultation` → `/book-an-appointment`, and `Speak With Our Immigration Team` (family, criminal, commercial, property, civil equivalents) → `tel:1300226725`.
- FAQ answers on the page, plus `FAQPage` JSON-LD. Easiest place is a small block in `practice_area.blade.php` keyed by `$type`, using the same Q&A as the visible FAQ, so the schema cannot drift from the HTML.

Where to edit: Admin → CMS pages, or a migration that updates `cms_pages.content` and `cms_pages.title` for those slugs. A migration is safer to deploy, because the live copy is already in the database and an admin save can be overwritten on the next import.

---

## Phase 5 — Practice areas index, footer, homepage cards

**`resources/views/practiceareas.blade.php`**

- [ ] Intro: `Legal advice in Melbourne across immigration, family, criminal, commercial, property and civil law.`
- [ ] Card titles: the short SEO names. Blurbs: the brief’s one-line card text.
- [ ] Immigration card links to `/migration-law` with label `Learn more about Immigration Lawyers`.
- [ ] Match the bullet lists to the brief (drop intellectual property, strata, and “visa compliance” if they are not in that page’s matter list).
- [ ] Remove the `500+` / `15+` / `98%` / `24/7` stats block.
- [ ] Add a Civil Lawyers card only in the same release as `/civil-law`.

**`resources/views/Elements/Frontend/footer.blade.php`**

- [ ] Practice links use the short SEO names and the same URLs.
- [ ] Add Civil Lawyers → `/civil-law` when that route exists.
- [ ] Footer description: `Melbourne lawyers for immigration, family, criminal, commercial, property and civil law. Level 8, 278 Collins St.`

**Homepage cards** use the same labels and blurbs as this grid, so the two pages do not disagree.

---

## Phase 6 — Civil lawyers page

Only after “Compensation-related matters” is deleted or replaced with a named category the firm actually takes.

- [ ] Route `GET /civil-law` in `routes/web.php`, next to `/property-law`, named `civil-law`.
- [ ] `HomeController::civillaw()` calling `renderPracticeAreaPage('civil-law')`.
- [ ] `cms_pages` row, slug `civil-law`, title `Civil Lawyers in Melbourne`, content from the brief.
- [ ] SEO override entry from the table.
- [ ] Sitemap path `/civil-law` in `app/Http/Controllers/SitemapController.php` `STATIC_PATHS`.
- [ ] Homepage card, practice-areas card, footer link.
- [ ] Related sidebar: cross-links to `/commercial-law` and `/property-law` only. No invented child URLs.

---

## Order of work

1. Phase 2 (template), so new content is not published under “Related migration topics”.
2. Phase 3 (titles), so the names match as soon as the body changes.
3. Phase 1 (homepage) and check it in the browser, including a 375px-wide hero.
4. Phase 4 for immigration and family first, then criminal, commercial, and property.
5. Phase 5 with the five existing services.
6. Phase 6 civil law last, then add its card and footer link.

---

## QA

- [ ] View source on `/`: title is `Lawyers in Melbourne | Bansal Lawyers`, one H1 is `Lawyers in Melbourne`, description matches this file, FAQ schema matches the visible FAQ.
- [ ] `/migration-law` title is `Immigration Lawyers Melbourne | Bansal Lawyers` and the hero H1 is `Immigration Lawyers in Melbourne`. Same check for the other four hubs.
- [ ] `/immigration-law` still 301s once to `/migration-law`.
- [ ] Family, criminal, commercial, and property pages do not show “Related migration topics”.
- [ ] Homepage still has testimonials, blog, both phone numbers, email, Collins St, and the enquiry form.
- [ ] No remaining copy: `no legal puzzle`, `best immigration lawyer`, `best lawyers`, `fight passionately`, `AAT`, `500+`, `98%`, `24/7`.
- [ ] Every card and in-content link returns 200.
- [ ] `/civil-law` is absent from the nav, footer, sitemap, and homepage until Phase 6 ships.
