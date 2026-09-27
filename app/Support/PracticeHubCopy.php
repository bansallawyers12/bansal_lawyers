<?php

namespace App\Support;

/**
 * Practice-hub copy from the website content brief.
 * Titles and meta strings follow the SEO names in docs/website-content-brief-review.md.
 * Visible FAQs and FAQPage schema both read faqsFor(), so the schema matches the page text.
 */
class PracticeHubCopy
{
    public static function cards(): array
    {
        return [
            [
                'title' => 'Immigration Lawyers',
                'href' => '/migration-law',
                'blurb' => 'Help with visa applications, visa refusals, visa cancellations, ART appeals, partner visas, student visas, skilled migration, permanent residency, and citizenship matters.',
                'icon' => 'handshake',
                'image' => 'images/immigration-law.png',
                'image_alt' => 'Immigration lawyers in Melbourne',
                'cta' => 'Learn more about Immigration Lawyers',
                'bullets' => [
                    'Visa applications',
                    'Visa refusals',
                    'Visa cancellations',
                    'ART appeals',
                    'Partner visas',
                    'Student visas',
                    'Skilled migration',
                    'Employer-sponsored visas',
                    'Permanent residency',
                    'Citizenship matters',
                ],
            ],
            [
                'title' => 'Family Lawyers',
                'href' => '/family-law',
                'blurb' => 'Advice for divorce, separation, parenting arrangements, property settlement, consent orders, family violence matters, and intervention orders.',
                'icon' => 'users',
                'image' => 'images/family-law.png',
                'image_alt' => 'Family lawyers in Melbourne',
                'cta' => 'Learn more about Family Lawyers',
                'bullets' => [
                    'Divorce',
                    'Separation advice',
                    'Parenting arrangements',
                    'Child custody matters',
                    'Property settlement',
                    'Consent orders',
                    'Family violence matters',
                    'Intervention orders',
                ],
            ],
            [
                'title' => 'Criminal Lawyers',
                'href' => '/criminal-law',
                'blurb' => 'Legal support for criminal charges, traffic offences, police matters, bail applications, intervention order breaches, and court representation.',
                'icon' => 'gavel',
                'image' => 'images/criminal-law.png',
                'image_alt' => 'Criminal lawyers in Melbourne',
                'cta' => 'Learn more about Criminal Lawyers',
                'bullets' => [
                    'Assault charges',
                    'Theft matters',
                    'Fraud matters',
                    'Drug offences',
                    'Traffic offences',
                    'Drink driving matters',
                    'Bail applications',
                    'Court representation',
                ],
            ],
            [
                'title' => 'Commercial Lawyers',
                'href' => '/commercial-law',
                'blurb' => 'Assistance with business contracts, commercial agreements, loan agreements, shareholder matters, business transactions, disputes, and debt recovery.',
                'icon' => 'briefcase',
                'image' => 'images/commercial-law.png',
                'image_alt' => 'Commercial lawyers in Melbourne',
                'cta' => 'Learn more about Commercial Lawyers',
                'bullets' => [
                    'Business contracts',
                    'Contract review',
                    'Loan agreements',
                    'Shareholder agreements',
                    'Business sale and purchase',
                    'Commercial disputes',
                    'Debt recovery',
                    'Legal notices',
                ],
            ],
            [
                'title' => 'Property Lawyers',
                'href' => '/property-law',
                'blurb' => 'Legal advice for buying, selling, leasing, contract review, conveyancing support, property disputes, and settlement-related matters.',
                'icon' => 'house',
                'image' => 'images/property-law.png',
                'image_alt' => 'Property lawyers in Melbourne',
                'cta' => 'Learn more about Property Lawyers',
                'bullets' => [
                    'Buying property',
                    'Selling property',
                    'Property contract review',
                    'Conveyancing-related legal support',
                    'Commercial leases',
                    'Property disputes',
                    'Settlement issues',
                    'Landlord and tenant matters',
                ],
            ],
            [
                'title' => 'Civil Lawyers',
                'href' => '/civil-law',
                'blurb' => 'Support for civil disputes, legal notices, debt disputes, contract disputes, negotiation, document preparation, and court-related processes.',
                'icon' => 'scale',
                'image' => null,
                'image_alt' => 'Civil lawyers in Melbourne',
                'cta' => 'Learn more about Civil Lawyers',
                'bullets' => [
                    'Civil disputes',
                    'Contract disputes',
                    'Debt disputes',
                    'Legal notices',
                    'Negotiation support',
                    'Document preparation',
                    'Court document preparation',
                    'General civil litigation advice',
                ],
            ],
        ];
    }

    public static function homeFaqs(): array
    {
        return [
            [
                'q' => 'What legal services does Bansal Lawyers provide?',
                'a' => 'Bansal Lawyers assists with immigration law, family law, criminal law, commercial law, property law, civil law, and dispute resolution.',
            ],
            [
                'q' => 'Is Bansal Lawyers based in Melbourne?',
                'a' => 'Yes. Bansal Lawyers is a Melbourne-based law firm assisting individuals, families, migrants, professionals, and businesses.',
            ],
            [
                'q' => 'Do you help with visa refusals and immigration appeals?',
                'a' => 'Yes. We assist with visa refusals, visa cancellations, ART appeals, partner visas, student visas, skilled migration, permanent residency, and citizenship matters.',
                'link_text' => 'visa refusals',
                'link_href' => '/migration-law',
            ],
            [
                'q' => 'Can you help with family law matters?',
                'a' => 'Yes. We assist with divorce, separation, parenting arrangements, property settlement, consent orders, family violence matters, and intervention orders.',
                'link_text' => 'divorce',
                'link_href' => '/family-law',
            ],
            [
                'q' => 'Do you handle criminal and traffic law matters?',
                'a' => 'Yes. We assist with criminal charges, traffic offences, police matters, bail applications, intervention order breaches, and court representation.',
            ],
            [
                'q' => 'How can I book a consultation?',
                'a' => 'You can contact Bansal Lawyers by phone, email, or through the website enquiry form to book a consultation.',
                'link_text' => 'book a consultation',
                'link_href' => '/book-an-appointment',
            ],
        ];
    }

    /**
     * @return list<array{q: string, a: string}>
     */
    public static function faqsFor(string $slug): array
    {
        return self::faqSets()[$slug] ?? [];
    }

    /**
     * @return array<string, array{title: string, meta_title: string, meta_description: string, content: string}>
     */
    public static function pages(): array
    {
        $meta = [
            'migration-law' => [
                'title' => 'Immigration Lawyers in Melbourne',
                'meta_title' => 'Immigration Lawyers Melbourne | Bansal Lawyers',
                'meta_description' => 'Bansal Lawyers helps clients with visa applications, refusals, cancellations, ART appeals, partner visas, student visas, skilled migration and citizenship matters.',
            ],
            'family-law' => [
                'title' => 'Family Lawyers in Melbourne',
                'meta_title' => 'Family Lawyers Melbourne | Divorce & Parenting',
                'meta_description' => 'Bansal Lawyers assists with divorce, separation, parenting matters, child custody, property settlement, consent orders, family violence and intervention orders.',
            ],
            'criminal-law' => [
                'title' => 'Criminal Lawyers in Melbourne',
                'meta_title' => 'Criminal Lawyers Melbourne | Criminal Defence',
                'meta_description' => 'Bansal Lawyers assists with criminal charges, traffic offences, assault matters, theft, fraud, drug offences, bail applications and court representation.',
            ],
            'commercial-law' => [
                'title' => 'Commercial Lawyers in Melbourne',
                'meta_title' => 'Commercial Lawyers Melbourne | Contracts & Disputes',
                'meta_description' => 'Bansal Lawyers assists with business contracts, commercial agreements, loan agreements, shareholder matters, business transactions, disputes and debt recovery.',
            ],
            'property-law' => [
                'title' => 'Property Lawyers in Melbourne',
                'meta_title' => 'Property Lawyers Melbourne | Leases & Contracts',
                'meta_description' => 'Bansal Lawyers assists with property contract review, buying and selling property, leases, conveyancing-related support, settlement issues and property disputes.',
            ],
            'civil-law' => [
                'title' => 'Civil Lawyers in Melbourne',
                'meta_title' => 'Civil Lawyers Melbourne | Disputes & Notices',
                'meta_description' => 'Bansal Lawyers assists with civil disputes, legal notices, contract disputes, debt disputes, negotiation, document preparation and court-related processes.',
            ],
        ];

        $builders = [
            'migration-law' => 'migrationContent',
            'family-law' => 'familyContent',
            'criminal-law' => 'criminalContent',
            'commercial-law' => 'commercialContent',
            'property-law' => 'propertyContent',
            'civil-law' => 'civilContent',
        ];

        $pages = [];
        foreach ($meta as $slug => $fields) {
            $method = $builders[$slug];
            $pages[$slug] = $fields + [
                'content' => self::$method() . self::faqsHtml(self::faqsFor($slug)),
            ];
        }

        return $pages;
    }

    /**
     * @return array<string, list<array{q: string, a: string}>>
     */
    private static function faqSets(): array
    {
        return [
            'migration-law' => [
                ['q' => 'Can Bansal Lawyers help with a visa refusal?', 'a' => 'Yes. We assist clients with visa refusal matters, review options, supporting evidence, and appeal-related advice where available.'],
                ['q' => 'Do you assist with ART appeals?', 'a' => 'Yes. We assist with ART appeal matters involving visa refusals, cancellations, and migration-related decisions.'],
                ['q' => 'Can you help with partner visa applications?', 'a' => 'Yes. We assist with partner visa applications, spouse visa matters, de facto relationship evidence, and document preparation.'],
                ['q' => 'Do you help with student visa matters?', 'a' => 'Yes. We assist with student visa applications, refusals, document review, and responses to immigration concerns.'],
                ['q' => 'When should I contact an immigration lawyer?', 'a' => 'You should seek advice early, especially if you have received a refusal, cancellation notice, request for information, or appeal deadline.'],
            ],
            'family-law' => [
                ['q' => 'Can Bansal Lawyers help with divorce?', 'a' => 'Yes. We assist with divorce applications, separation advice, and related family law issues.'],
                ['q' => 'Do you assist with child custody matters?', 'a' => 'Yes. We assist with parenting arrangements, child custody matters, consent orders, and family law negotiations.'],
                ['q' => 'Can you help with property settlement after separation?', 'a' => 'Yes. We assist with property settlement matters involving assets, debts, superannuation, business interests, and financial arrangements.'],
                ['q' => 'Do you handle family violence matters?', 'a' => 'Yes. We assist with family violence matters, intervention orders, and related family law issues.'],
                ['q' => 'When should I contact a family lawyer?', 'a' => 'You should seek legal advice early if you are separating, dealing with parenting issues, receiving legal documents, or concerned about property or safety matters.'],
            ],
            'criminal-law' => [
                ['q' => 'Can Bansal Lawyers help with criminal charges?', 'a' => 'Yes. We assist clients with criminal charges, court documents, police matters, and criminal defence advice.'],
                ['q' => 'Do you handle traffic offences?', 'a' => 'Yes. We assist with traffic offences, drink driving matters, licence-related issues, and court representation.'],
                ['q' => 'Can you help before a police interview?', 'a' => 'Yes. If police have contacted you, you should seek legal advice before attending an interview or giving a statement.'],
                ['q' => 'Do you assist with bail applications?', 'a' => 'Yes. We assist with bail-related advice, preparation, and court representation where required.'],
                ['q' => 'When should I contact a criminal lawyer?', 'a' => 'You should contact a criminal lawyer as soon as police contact you, you receive court documents, or you become aware of a criminal allegation.'],
            ],
            'commercial-law' => [
                ['q' => 'Can Bansal Lawyers review business contracts?', 'a' => 'Yes. We assist with reviewing, drafting, and advising on business contracts and commercial agreements.'],
                ['q' => 'Do you help with commercial disputes?', 'a' => 'Yes. We assist with commercial disputes, contract disputes, unpaid debts, legal notices, negotiations, and court-related steps.'],
                ['q' => 'Can you help with loan agreements?', 'a' => 'Yes. We assist with loan agreements, business lending documents, and related commercial legal advice.'],
                ['q' => 'Do you assist with buying or selling a business?', 'a' => 'Yes. We assist with business sale and purchase matters, contract review, negotiations, and settlement-related legal steps.'],
                ['q' => 'When should a business contact a commercial lawyer?', 'a' => 'A business should contact a commercial lawyer before signing contracts, entering agreements, buying or selling a business, or when a dispute begins.'],
            ],
            'property-law' => [
                ['q' => 'Can Bansal Lawyers review property contracts?', 'a' => 'Yes. We assist with reviewing property contracts and explaining important terms, risks, and obligations.'],
                ['q' => 'Do you help with buying and selling property?', 'a' => 'Yes. We assist buyers and sellers with contract review, legal advice, and settlement-related issues.'],
                ['q' => 'Can you review commercial leases?', 'a' => 'Yes. We assist landlords, tenants, and business owners with commercial lease review and advice.'],
                ['q' => 'Do you assist with property disputes?', 'a' => 'Yes. We assist with property disputes, legal notices, negotiations, and court-related processes where required.'],
                ['q' => 'When should I contact a property lawyer?', 'a' => 'You should contact a property lawyer before signing a contract or lease, or as soon as a property dispute or settlement issue arises.'],
            ],
            'civil-law' => [
                ['q' => 'What is a civil law matter?', 'a' => 'A civil law matter usually involves disputes between individuals, businesses, or other parties. These can include contract disputes, debt disputes, property disputes, and other non-criminal legal issues.'],
                ['q' => 'Can Bansal Lawyers help with legal notices?', 'a' => 'Yes. We assist with preparing, reviewing, and responding to legal notices.'],
                ['q' => 'Do you help with contract disputes?', 'a' => 'Yes. We assist with contract disputes, document review, negotiation, and court-related steps where required.'],
                ['q' => 'Can you help with debt disputes?', 'a' => 'Yes. We assist with debt disputes, unpaid amounts, legal notices, negotiation, and recovery-related advice.'],
                ['q' => 'When should I contact a civil lawyer?', 'a' => 'You should contact a civil lawyer when a dispute starts, before sending a legal notice, before responding to a claim, or before taking court-related steps.'],
            ],
        ];
    }

    private static function actions(string $teamLabel): string
    {
        return '<p class="pae-actions"><a class="pae-btn" href="/book-an-appointment">Book a Consultation</a><a class="pae-btn pae-btn-outline" href="tel:1300226725">' . e($teamLabel) . '</a></p>';
    }

    /**
     * @param  list<array{q: string, a: string}>  $faqs
     */
    private static function faqsHtml(array $faqs): string
    {
        $html = '<h2>FAQs</h2>';
        foreach ($faqs as $faq) {
            $html .= '<h3>' . e($faq['q']) . '</h3><p>' . e($faq['a']) . '</p>';
        }

        return $html;
    }

    private static function migrationContent(): string
    {
        $top = self::actions('Speak With Our Immigration Team');
        $again = self::actions('Speak With Our Immigration Team');

        return <<<HTML
<p>Immigration matters can affect your family, work, study, business, and future in Australia. When a visa application, refusal, cancellation, or appeal is involved, clear legal advice is important.</p>
<p>Bansal Lawyers assists clients with a range of immigration and migration law matters in Melbourne. We help you understand your options, prepare the right documents, and take the next steps based on your situation.</p>
{$top}
<h2>Immigration Advice Based on Your Situation</h2>
<p>Every immigration matter is unique—whether you need visa assistance, face a refusal or cancellation, or have an upcoming appeal deadline or information request.</p>
<p>We review your background, documents, visa history, and deadlines to provide clear, actionable legal advice tailored to your options.</p>
<h2>Immigration Matters We Assist With</h2>
<p>Bansal Lawyers can assist with:</p>
<ul>
<li>Visa applications</li>
<li><a href="/visa-refusals-visa-cancellation">Visa refusals</a></li>
<li><a href="/visa-refusals-visa-cancellation">Visa cancellations</a></li>
<li><a href="/art-application">ART appeals</a></li>
<li>Partner visas</li>
<li>Student visas</li>
<li>Skilled migration</li>
<li>Employer-sponsored visas</li>
<li>Permanent residency</li>
<li>Citizenship matters</li>
<li>Requests for further information</li>
<li>Immigration document review</li>
</ul>
<h2>Visa Refusals and Appeals</h2>
<p>A visa refusal can be stressful, especially when you have limited time to respond or appeal. The next step depends on the type of visa, the reason for refusal, and whether review rights are available.</p>
<p>We help clients review <a href="/visa-refusals-visa-cancellation">refusal decisions</a>, understand the reasons given by the Department, prepare supporting evidence, and respond through the appropriate legal process. Where merits review is available, that can include an <a href="/art-application">ART appeal</a>. Where court review is the right step, that can include a <a href="/federal-court-application">Federal Court application</a>.</p>
<p>If your visa has been refused, do not delay. Appeal deadlines can be strict.</p>
<h2>Partner Visa and Family Migration</h2>
<p>Partner visa matters require strong evidence and careful preparation. A weak application or missing information can cause delays or refusal.</p>
<p>We assist clients with partner visa applications, spouse visa matters, de facto relationship evidence, document preparation, and responses to immigration concerns.</p>
<h2>Student Visa and Skilled Migration</h2>
<p>Students and skilled workers often need guidance on eligibility, documents, Genuine Student requirements, work-related evidence, sponsorship pathways, and long-term visa planning.</p>
<p>We help clients understand the process clearly before submitting or responding to a visa matter.</p>
<h2>Why Choose Bansal Lawyers for Immigration Matters?</h2>
<p>Immigration law can be complex, and small mistakes can create major issues. We provide clear advice, careful document review, and practical guidance at each stage of the matter.</p>
<p>Our approach includes:</p>
<ul>
<li>Clear explanation of your immigration options</li>
<li>Review of visa history and documents</li>
<li>Assistance with refusal and cancellation matters</li>
<li>Support with appeals and evidence preparation</li>
<li>Practical advice based on deadlines and risk</li>
<li>Professional handling of sensitive immigration matters</li>
</ul>
<h2>Speak With Immigration Lawyers in Melbourne</h2>
<p>If you need help with a visa application, refusal, cancellation, appeal, or immigration advice, Bansal Lawyers can guide you through the next step.</p>
{$again}
HTML;
    }

    private static function familyContent(): string
    {
        $top = self::actions('Speak With Our Family Law Team');
        $again = self::actions('Speak With Our Family Law Team');

        return <<<HTML
<p>Family law matters are personal and can be difficult to manage without proper legal advice. Separation, divorce, parenting arrangements, property settlement, family violence matters, and consent orders can affect your family, finances, and future.</p>
<p>Bansal Lawyers helps clients understand their rights, responsibilities, and legal options in family law matters. We provide practical advice and support through each stage of the process.</p>
{$top}
<h2>Clear Advice for Family Law Matters</h2>
<p>When a family issue becomes a legal issue, emotions can make decisions harder. The right advice can help you understand what needs to be done, what documents are required, and what options may be available.</p>
<p>We aim to provide calm, clear, and practical guidance. Where possible, we help clients resolve matters without unnecessary conflict. Where court action is needed, we help clients prepare properly.</p>
<h2>Family Law Matters We Assist With</h2>
<p>Bansal Lawyers can assist with:</p>
<ul>
<li><a href="/divorce">Divorce</a></li>
<li>Separation advice</li>
<li><a href="/child-custody">Parenting arrangements</a></li>
<li><a href="/child-custody">Child custody matters</a></li>
<li><a href="/property-settlement">Property settlement</a></li>
<li>Consent orders</li>
<li>Binding financial agreements</li>
<li><a href="/family-violence">Family violence matters</a></li>
<li>Intervention orders</li>
<li>Spousal maintenance</li>
<li>Child support issues</li>
<li>Family law negotiations</li>
</ul>
<h2>Divorce and Separation</h2>
<p><a href="/divorce">Divorce</a> and separation can involve more than ending a relationship. Clients may also need advice about children, property, financial arrangements, and future responsibilities.</p>
<p>We help clients understand the divorce process, legal requirements, documents needed, and related family law issues that may need to be resolved. For a detailed look at divorce in Melbourne, see <a href="/divorce-lawyers-melbourne">divorce lawyers in Melbourne</a>.</p>
<h2>Parenting and Child Custody Matters</h2>
<p><a href="/child-custody">Parenting</a> matters should be handled carefully, especially when children’s living arrangements, communication, schooling, travel, or safety concerns are involved.</p>
<p>We assist with parenting arrangements, child custody matters, consent orders, negotiations, and court-related steps where required.</p>
<h2>Property Settlement</h2>
<p><a href="/property-settlement">Property settlement</a> can involve the family home, savings, loans, business interests, superannuation, investments, and other assets or debts.</p>
<p>We help clients understand their position, prepare documents, and work toward a practical resolution based on their circumstances.</p>
<h2>Family Violence and Intervention Orders</h2>
<p>Family violence matters need prompt and careful legal attention. These cases may involve safety concerns, parenting arrangements, police involvement, or court orders.</p>
<p>Bansal Lawyers assists clients with <a href="/family-violence">family violence matters</a>, intervention orders, and related family law issues.</p>
<h2>Why Choose Bansal Lawyers for Family Law?</h2>
<p>Family law needs more than legal knowledge. It needs patience, clear communication, and proper preparation.</p>
<p>Our approach includes:</p>
<ul>
<li>Practical advice in plain language</li>
<li>Support during stressful family situations</li>
<li>Careful review of documents and facts</li>
<li>Guidance on parenting and property matters</li>
<li>Assistance with consent orders and negotiations</li>
<li>Professional handling of sensitive matters</li>
</ul>
<h2>Speak With Family Lawyers in Melbourne</h2>
<p>If you are dealing with separation, divorce, parenting issues, property settlement, or family violence matters, Bansal Lawyers can help you understand your next step.</p>
{$again}
HTML;
    }

    private static function criminalContent(): string
    {
        $top = self::actions('Speak With Our Criminal Law Team');
        $again = self::actions('Speak With Our Criminal Law Team');

        return <<<HTML
<p>Being charged with a criminal offence or contacted by police can be stressful. What you say and do early can affect the direction of the matter.</p>
<p>Bansal Lawyers assists clients with criminal law and traffic law matters in Melbourne. We help clients understand the charge, the possible consequences, and the legal steps available.</p>
{$top}
<h2>Get Legal Advice Before Taking the Next Step</h2>
<p>If police have contacted you, you have received court documents, or you are facing a criminal charge, it is important to get advice before making decisions.</p>
<p>We can review your situation, explain the process, and help you prepare for police interviews, court appearances, or negotiations where required.</p>
<h2>Criminal Law Matters We Assist With</h2>
<p>Bansal Lawyers can assist with:</p>
<ul>
<li><a href="/assault-charges">Assault charges</a></li>
<li>Theft matters</li>
<li>Fraud matters</li>
<li>Drug offences</li>
<li><a href="/traffic-offences">Traffic offences</a></li>
<li><a href="/drink-driving-offences">Drink driving matters</a></li>
<li>Family violence charges</li>
<li>Bail applications</li>
<li><a href="/intervention-orders">Intervention order breaches</a></li>
<li>Police interview advice</li>
<li>Court representation</li>
<li>General criminal defence advice</li>
</ul>
<h2>Assault, Theft, Fraud and Drug Offences</h2>
<p>Criminal allegations can affect your record, employment, family, travel, and future opportunities. Each matter needs to be reviewed carefully based on the facts, evidence, and legal process involved.</p>
<p>We assist clients with advice, preparation, and representation for different types of criminal charges, including <a href="/assault-charges">assault charges</a>.</p>
<h2>Traffic Offences and Drink Driving</h2>
<p><a href="/traffic-offences">Traffic offences</a> can lead to fines, licence suspension, loss of points, court appearances, or other consequences.</p>
<p>We assist with <a href="/drink-driving-offences">drink driving matters</a>, driving offences, traffic charges, and court-related traffic matters.</p>
<h2>Family Violence Charges and Intervention Order Breaches</h2>
<p>Family violence-related criminal matters can involve police, court orders, parenting issues, and personal safety concerns.</p>
<p>We assist clients with family violence charges, <a href="/intervention-orders">intervention order breaches</a>, and related criminal law issues.</p>
<h2>Bail Applications and Court Representation</h2>
<p>If a matter involves bail or urgent court attendance, early legal advice is important. We help clients understand the process, prepare documents, and respond to court requirements.</p>
<h2>Why Choose Bansal Lawyers for Criminal Law?</h2>
<p>Criminal matters need careful handling, clear advice, and timely action.</p>
<p>Our approach includes:</p>
<ul>
<li>Clear explanation of charges and process</li>
<li>Review of evidence and court documents</li>
<li>Advice before police interviews</li>
<li>Assistance with bail and court matters</li>
<li>Practical guidance on possible legal options</li>
<li>Professional support during stressful situations</li>
</ul>
<h2>Speak With Criminal Lawyers in Melbourne</h2>
<p>If you are facing a criminal charge, traffic matter, court date, or police contact, Bansal Lawyers can help you understand your next step.</p>
{$again}
HTML;
    }

    private static function commercialContent(): string
    {
        $top = self::actions('Speak With Our Commercial Law Team');
        $again = self::actions('Speak With Our Commercial Law Team');

        return <<<HTML
<p>Business matters should be properly documented and legally reviewed before problems arise. Unclear contracts, unpaid debts, weak agreements, and unresolved disputes can create serious risk for a business.</p>
<p>Bansal Lawyers assists business owners, companies, professionals, investors, and commercial clients with practical legal advice across a range of commercial law matters.</p>
{$top}
<h2>Practical Legal Advice for Business Matters</h2>
<p>Commercial legal issues need clear thinking and proper documentation. Whether you are starting a business, reviewing a contract, entering into an agreement, resolving a dispute, or recovering a debt, legal advice can help protect your position.</p>
<p>We work with clients to understand the commercial issue, review documents, explain risks, and help decide the right next step.</p>
<h2>Commercial Law Matters We Assist With</h2>
<p>Bansal Lawyers can assist with:</p>
<ul>
<li><a href="/contracts-or-business-agreements">Business contracts</a></li>
<li><a href="/contracts-or-business-agreements">Contract review</a></li>
<li><a href="/contracts-or-business-agreements">Commercial agreements</a></li>
<li><a href="/loan-agreement">Loan agreements</a></li>
<li>Shareholder agreements</li>
<li>Partnership agreements</li>
<li><a href="/leasing-or-selling-a-business">Business sale and purchase matters</a></li>
<li>Commercial disputes</li>
<li>Debt recovery</li>
<li>Business legal advice</li>
<li>Negotiations and settlements</li>
<li>Legal notices</li>
</ul>
<h2>Contract Review and Commercial Agreements</h2>
<p><a href="/contracts-or-business-agreements">Contracts</a> should be clear, practical, and properly drafted. Poor wording can create confusion, disputes, and financial risk.</p>
<p>We assist with reviewing, drafting, and advising on business contracts, service agreements, <a href="/loan-agreement">loan agreements</a>, shareholder agreements, partnership agreements, and other commercial documents.</p>
<h2>Business Sale and Purchase Matters</h2>
<p>Buying or selling a business involves important legal and financial decisions. Contracts, lease terms, assets, liabilities, employee matters, and settlement conditions should be reviewed carefully.</p>
<p>We assist clients with <a href="/leasing-or-selling-a-business">business sale and purchase matters</a>, document review, negotiations, and legal guidance before completion.</p>
<h2>Commercial Disputes and Debt Recovery</h2>
<p>Business disputes can affect cash flow, operations, relationships, and reputation. These matters should be handled early before they become more expensive.</p>
<p>We assist with commercial disputes, unpaid debts, contract disputes, legal notices, negotiation, and court-related processes where required.</p>
<h2>Why Choose Bansal Lawyers for Commercial Law?</h2>
<p>Business clients need legal advice that is clear, practical, and commercially sensible.</p>
<p>Our approach includes:</p>
<ul>
<li>Careful review of commercial documents</li>
<li>Practical advice based on business risk</li>
<li>Clear explanation of contract terms</li>
<li>Support with disputes and negotiations</li>
<li>Assistance with business sale and purchase matters</li>
<li>Legal guidance for business owners and companies</li>
</ul>
<h2>Speak With Commercial Lawyers in Melbourne</h2>
<p>If you need help with a contract, agreement, business transaction, dispute, or debt recovery matter, Bansal Lawyers can assist you with practical legal advice.</p>
{$again}
HTML;
    }

    private static function propertyContent(): string
    {
        $top = self::actions('Speak With Our Property Law Team');
        $again = self::actions('Speak With Our Property Law Team');

        return <<<HTML
<p>Property matters often involve major financial decisions. Whether you are buying, selling, leasing, transferring, or dealing with a dispute, it is important to understand your legal position before signing or committing.</p>
<p>Bansal Lawyers assists individuals, investors, landlords, tenants, business owners, buyers, and sellers with a range of property law matters in Melbourne.</p>
{$top}
<h2>Legal Advice Before You Sign</h2>
<p>Property contracts and leases can include obligations, risks, deadlines, and conditions that are not always easy to understand. Getting advice before signing can help you avoid problems later.</p>
<p>We review documents, explain key terms, identify risks, and guide clients through the next steps.</p>
<h2>Property Law Matters We Assist With</h2>
<p>Bansal Lawyers can assist with:</p>
<ul>
<li>Buying property</li>
<li>Selling property</li>
<li>Property contract review</li>
<li><a href="/conveyancing">Conveyancing-related legal support</a></li>
<li>Commercial leases</li>
<li>Residential lease issues</li>
<li>Property disputes</li>
<li>Settlement issues</li>
<li>Property transfers</li>
<li>Landlord and tenant matters</li>
<li>Property-related legal notices</li>
</ul>
<h2>Buying or Selling Property</h2>
<p>Buying or selling property involves contracts, deadlines, finance conditions, settlement requirements, and legal obligations.</p>
<p>We assist clients with property contract review, legal advice before signing, settlement-related concerns, and issues that may arise during the process.</p>
<h2>Commercial Leases and Lease Review</h2>
<p>Commercial leases can create long-term obligations for business owners, landlords, and tenants. Terms relating to rent, outgoings, renewal, maintenance, fit-out, default, and termination should be reviewed carefully.</p>
<p>We assist with lease review, lease advice, commercial tenancy issues, and lease-related disputes.</p>
<h2>Property Disputes</h2>
<p>Property disputes can involve buyers, sellers, landlords, tenants, neighbours, business owners, or other parties. These matters can become stressful and expensive if not handled early.</p>
<p>We assist with property disputes, legal notices, negotiation, document review, and court-related processes where required. That includes <a href="/caveats-disputes-and-removal">caveats</a> and <a href="/building-and-construction-disputes">building and construction disputes</a>.</p>
<h2>Why Choose Bansal Lawyers for Property Law?</h2>
<p>Property matters need careful document review and practical advice.</p>
<p>Our approach includes:</p>
<ul>
<li>Clear explanation of contract and lease terms</li>
<li>Review of key risks before signing</li>
<li>Support for buyers, sellers, landlords, and tenants</li>
<li>Assistance with settlement and dispute issues</li>
<li>Practical advice on property obligations</li>
<li>Professional handling of property-related documents</li>
</ul>
<h2>Speak With Property Lawyers in Melbourne</h2>
<p>If you need help with a property contract, lease, dispute, settlement issue, or transfer matter, Bansal Lawyers can guide you through the process.</p>
{$again}
HTML;
    }

    private static function civilContent(): string
    {
        $top = self::actions('Speak With Our Civil Law Team');
        $again = self::actions('Speak With Our Civil Law Team');

        return <<<HTML
<p>Civil disputes can happen between individuals, businesses, landlords, tenants, service providers, customers, partners, or other parties. These matters can become stressful when communication breaks down or money, contracts, property, or personal rights are involved.</p>
<p>Bansal Lawyers assists clients with civil law matters, dispute resolution, legal notices, negotiation, document preparation, and court-related processes where required.</p>
{$top}
<h2>Practical Advice for Civil Disputes</h2>
<p>A civil dispute should be handled with proper advice from the start. The right approach depends on the facts, documents, evidence, legal position, and the outcome you want to achieve.</p>
<p>We help clients understand the strength of their position, possible risks, and available next steps.</p>
<h2>Civil Law Matters We Assist With</h2>
<p>Bansal Lawyers can assist with:</p>
<ul>
<li>Civil disputes</li>
<li>Contract disputes</li>
<li>Debt disputes</li>
<li>Legal notices</li>
<li>Negotiation support</li>
<li>Document preparation</li>
<li><a href="/property-law">Property-related disputes</a></li>
<li><a href="/commercial-law">Business-related disputes</a></li>
<li>Court document preparation</li>
<li>General civil litigation advice</li>
</ul>
<p>If the issue is a business contract, commercial agreement, or business dispute, our <a href="/commercial-law">commercial lawyers</a> page sets out that work. If it is a lease, contract of sale, caveat, or other property issue, see <a href="/property-law">property lawyers</a>.</p>
<h2>Contract and Debt Disputes</h2>
<p>Disputes often begin when one party does not follow an agreement, refuses payment, delays action, or disagrees about terms.</p>
<p>We assist clients with contract disputes, debt disputes, unpaid amounts, legal notices, negotiation, and court-related steps where required.</p>
<h2>Legal Notices and Negotiation</h2>
<p>In many civil matters, a properly prepared legal notice or negotiation strategy can help clarify the issue and create a path toward resolution.</p>
<p>We assist with reviewing the dispute, preparing correspondence, responding to claims, and advising on practical options.</p>
<h2>Court-Related Civil Matters</h2>
<p>Some disputes cannot be resolved through communication or negotiation. In those situations, court-related steps may be required.</p>
<p>We assist with civil litigation advice, document preparation, evidence review, and guidance on the process involved.</p>
<h2>Why Choose Bansal Lawyers for Civil Law?</h2>
<p>Civil disputes need clear advice, strong documentation, and practical decision-making.</p>
<p>Our approach includes:</p>
<ul>
<li>Review of facts, documents, and evidence</li>
<li>Clear explanation of legal options</li>
<li>Assistance with legal notices and responses</li>
<li>Practical advice on dispute resolution</li>
<li>Support with negotiation and preparation</li>
<li>Professional handling of court-related steps</li>
</ul>
<h2>Speak With Civil Lawyers in Melbourne</h2>
<p>If you are involved in a civil dispute or need advice before sending or responding to a legal notice, Bansal Lawyers can help you understand your options.</p>
{$again}
HTML;
    }
}
