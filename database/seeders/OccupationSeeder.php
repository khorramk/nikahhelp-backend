<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class OccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('occupations')->delete();
        $occupations = [
            ['name' => "Other"],
            ['name' => "Academic librarian"],
            ['name' => "Academic researcher"],
            ['name' => "Accommodation manager"],
            ['name' => "Accounting technician"],
            ['name' => "Acoustic consultant"],
            ['name' => "Actor"],
            ['name' => "Actuarial analyst"],
            ['name' => "Actuary"],
            ['name' => "Acupuncturist"],
            ['name' => "Adult guidance worker"],
            ['name' => "Adult nurse"],
            ['name' => "Advertising account executive"],
            ['name' => "Advertising account planner"],
            ['name' => "Advertising art director"],
            ['name' => "Advertising copywriter"],
            ['name' => "Advice worker"],
            ['name' => "Aerospace engineer"],
            ['name' => "Agricultural consultant"],
            ['name' => "Air cabin crew"],
            ['name' => "Air traffic controller"],
            ['name' => "Airline pilot"],
            ['name' => "Amenity horticulturist"],
            ['name' => "Anaesthetist"],
            ['name' => "Analytical chemist"],
            ['name' => "Animal nutritionist"],
            ['name' => "Animal physiotherapist"],
            ['name' => "Animal technician"],
            ['name' => "Animator"],
            ['name' => "Application analyst"],
            ['name' => "Applications developer"],
            ['name' => "Arbitrator"],
            ['name' => "Arboriculturist"],
            ['name' => "Archaeologist"],
            ['name' => "Architect"],
            ['name' => "Architectural technologist"],
            ['name' => "Archivist"],
            ['name' => "Armed forces logistics officer"],
            ['name' => "Armed forces operational officer"],
            ['name' => "Armed forces technical officer"],
            ['name' => "Art therapist"],
            ['name' => "Arts administrator"],
            ['name' => "Artworker"],
            ['name' => "Astronomer"],
            ['name' => "Automotive engineer"],
            ['name' => "Barrister"],
            ['name' => "Barristers' clerk"],
            ['name' => "Biomedical engineer"],
            ['name' => "Biomedical scientist"],
            ['name' => "Biotechnologist"],
            ['name' => "Bookseller"],
            ['name' => "Border Force officer"],
            ['name' => "Broadcast engineer"],
            ['name' => "Broadcast journalist"],
            ['name' => "Broadcast presenter"],
            ['name' => "Building control surveyor"],
            ['name' => "Building services engineer"],
            ['name' => "Building surveyor"],
            ['name' => "Business adviser"],
            ['name' => "Business analyst"],
            ['name' => "Business development manager"],
            ['name' => "CAD technician"],
            ['name' => "Call centre manager"],
            ['name' => "Cardiologist"],
            ['name' => "Care manager"],
            ['name' => "Careers adviser"],
            ['name' => "Careers information officer"],
            ['name' => "Cartographer"],
            ['name' => "Catering manager"],
            ['name' => "Ceramics designer"],
            ['name' => "Chaplain"],
            ['name' => "Charity fundraiser"],
            ['name' => "Charity officer"],
            ['name' => "Chartered accountant"],
            ['name' => "Chartered certified accountant"],
            ['name' => "Chartered legal executive"],
            ['name' => "Chartered loss adjuster"],
            ['name' => "Chartered management accountant"],
            ['name' => "Chartered public finance accountant"],
            ['name' => "Chef"],
            ['name' => "Chemical engineer"],
            ['name' => "Child psychotherapist"],
            ['name' => "Children's nurse"],
            ['name' => "Chiropractor"],
            ['name' => "Choreographer"],
            ['name' => "Civil Service administrator"],
            ['name' => "Civil Service Fast Streamer"],
            ['name' => "Clinical psychologist"],
            ['name' => "Clinical radiologist"],
            ['name' => "Clinical research associate"],
            ['name' => "Clinical scientist, audiology"],
            ['name' => "Clinical scientist, biochemistry"],
            ['name' => "Clinical scientist, cardiac sciences"],
            ['name' => "Clinical scientist, embryology"],
            ['name' => "Clinical scientist, genomics"],
            ['name' => "Clinical scientist, haematology"],
            ['name' => "Clinical scientist, immunology"],
            ['name' => "Clinical scientist, medical physics"],
            ['name' => "Clinical technologist"],
            ['name' => "Clothing/textile technologist"],
            ['name' => "Colour technologist"],
            ['name' => "Commercial art gallery manager"],
            ['name' => "Commercial horticulturist"],
            ['name' => "Commercial & residential surveyor"],
            ['name' => "Commissioning editor"],
            ['name' => "Communications engineer"],
            ['name' => "Community arts worker"],
            ['name' => "Community development worker"],
            ['name' => "Community education officer"],
            ['name' => "Community pharmacist"],
            ['name' => "Company secretary"],
            ['name' => "Compliance officer"],
            ['name' => "Concept artist"],
            ['name' => "Conference centre manager"],
            ['name' => "Conservator"],
            ['name' => "Construction manager"],
            ['name' => "Consulting civil engineer"],
            ['name' => "Contracting civil engineer"],
            ['name' => "Control and instrumentation engineer"],
            ['name' => "Corporate investment banker"],
            ['name' => "Corporate treasurer"],
            ['name' => "Costs lawyer"],
            ['name' => "Counselling psychologist"],
            ['name' => "Counsellor"],
            ['name' => "Creative director"],
            ['name' => "Crime scene investigator"],
            ['name' => "Customer service manager"],
            ['name' => "Cyber security analyst"],
            ['name' => "Dance movement psychotherapist"],
            ['name' => "Dancer"],
            ['name' => "Data analyst"],
            ['name' => "Data scientist"],
            ['name' => "Database administrator"],
            ['name' => "Dental hygienist"],
            ['name' => "Dental technician"],
            ['name' => "Dental therapist"],
            ['name' => "Dentist"],
            ['name' => "Design engineer"],
            ['name' => "Detective"],
            ['name' => "Diagnostic radiographer"],
            ['name' => "Dietitian"],
            ['name' => "Digital copywriter"],
            ['name' => "Digital marketer"],
            ['name' => "Diplomatic service officer"],
            ['name' => "Dispensing optician"],
            ['name' => "Dramatherapist"],
            ['name' => "Drilling engineer"],
            ['name' => "Early years teacher"],
            ['name' => "Ecologist"],
            ['name' => "Economist"],
            ['name' => "Editorial assistant"],
            ['name' => "Education administrator"],
            ['name' => "Education consultant"],
            ['name' => "Educational psychologist"],
            ['name' => "Electrical engineer"],
            ['name' => "Electronics engineer"],
            ['name' => "Emergency planning officer"],
            ['name' => "Energy engineer"],
            ['name' => "Energy manager"],
            ['name' => "Engineering geologist"],
            ['name' => "English as a foreign language teacher"],
            ['name' => "Environmental consultant"],
            ['name' => "Environmental education officer"],
            ['name' => "Environmental engineer"],
            ['name' => "Environmental health practitioner"],
            ['name' => "Environmental manager"],
            ['name' => "Epidemiologist"],
            ['name' => "Equality, diversity and inclusion officer"],
            ['name' => "Ergonomist"],
            ['name' => "Estate agent"],
            ['name' => "Estates manager"],
            ['name' => "Estimator"],
            ['name' => "Event manager"],
            ['name' => "Exercise physiologist"],
            ['name' => "Exhibition designer"],
            ['name' => "External auditor"],
            ['name' => "Facilities manager"],
            ['name' => "Family support worker"],
            ['name' => "Farm manager"],
            ['name' => "Fashion designer"],
            ['name' => "Fast food restaurant manager"],
            ['name' => "Field trials officer"],
            ['name' => "Film director"],
            ['name' => "Film/video editor"],
            ['name' => "Financial adviser"],
            ['name' => "Financial manager"],
            ['name' => "Financial risk analyst"],
            ['name' => "Financial trader"],
            ['name' => "Fine artist"],
            ['name' => "Fire risk assessor"],
            ['name' => "Firefighter"],
            ['name' => "Fish farm manager"],
            ['name' => "Fisheries officer"],
            ['name' => "Fitness centre manager"],
            ['name' => "Food technologist"],
            ['name' => "Forensic accountant"],
            ['name' => "Forensic computer analyst"],
            ['name' => "Forensic psychologist"],
            ['name' => "Forensic scientist"],
            ['name' => "Forest/woodland manager"],
            ['name' => "Freight forwarder"],
            ['name' => "Furniture conservator/restorer"],
            ['name' => "Furniture designer"],
            ['name' => "Further education teacher"],
            ['name' => "Game artist"],
            ['name' => "Game designer"],
            ['name' => "Game developer"],
            ['name' => "General practice doctor"],
            ['name' => "Genetic counsellor"],
            ['name' => "Geochemist"],
            ['name' => "Geographical information officer"],
            ['name' => "Geophysicist"],
            ['name' => "Geoscientist"],
            ['name' => "Geotechnical engineer"],
            ['name' => "Glass blower/designer"],
            ['name' => "Government social research officer"],
            ['name' => "Graphic designer"],
            ['name' => "Health and safety adviser"],
            ['name' => "Health and safety inspector"],
            ['name' => "Health play specialist"],
            ['name' => "Health promotion specialist"],
            ['name' => "Health psychologist"],
            ['name' => "Health service manager"],
            ['name' => "Health visitor"],
            ['name' => "Herbalist"],
            ['name' => "Heritage manager"],
            ['name' => "High intensity therapist"],
            ['name' => "Higher education careers adviser"],
            ['name' => "Higher education lecturer"],
            ['name' => "Historic buildings inspector"],
            ['name' => "Holiday representative"],
            ['name' => "Homeopath"],
            ['name' => "Horticultural consultant"],
            ['name' => "Horticultural therapist"],
            ['name' => "Hospital doctor"],
            ['name' => "Hospital pharmacist"],
            ['name' => "Hotel manager"],
            ['name' => "Housing manager/officer"],
            ['name' => "Human resources officer"],
            ['name' => "Hydrogeologist"],
            ['name' => "Hydrographic surveyor"],
            ['name' => "Hydrologist"],
            ['name' => "Illustrator"],
            ['name' => "Information officer"],
            ['name' => "Information systems manager"],
            ['name' => "Insurance account manager"],
            ['name' => "Insurance broker"],
            ['name' => "Insurance claims handler"],
            ['name' => "Insurance risk surveyor"],
            ['name' => "Insurance underwriter"],
            ['name' => "Intelligence analyst"],
            ['name' => "Interior and spatial designer"],
            ['name' => "Internal auditor"],
            ['name' => "International development worker"],
            ['name' => "Interpreter"],
            ['name' => "Investment analyst"],
            ['name' => "IT consultant"],
            ['name' => "IT sales professional"],
            ['name' => "IT technical support officer"],
            ['name' => "IT trainer"],
            ['name' => "Jewellery designer"],
            ['name' => "Land-based engineer"],
            ['name' => "Land/geomatics surveyor"],
            ['name' => "Landscape architect"],
            ['name' => "Learning disability nurse"],
            ['name' => "Learning mentor"],
            ['name' => "Lexicographer"],
            ['name' => "Licensed conveyancer"],
            ['name' => "Life coach"],
            ['name' => "Lighting technician, broadcasting,film,video"],
            ['name' => "Local government officer"],
            ['name' => "Location manager"],
            ['name' => "Logistics and distribution manager"],
            ['name' => "Machine learning engineer"],
            ['name' => "Magazine features editor"],
            ['name' => "Magazine journalist"],
            ['name' => "Maintenance engineer"],
            ['name' => "Make-up artist"],
            ['name' => "Management consultant"],
            ['name' => "Manufacturing engineer"],
            ['name' => "Manufacturing systems engineer"],
            ['name' => "Marine biologist"],
            ['name' => "Marine scientist"],
            ['name' => "Market researcher"],
            ['name' => "Marketing executive"],
            ['name' => "Materials engineer"],
            ['name' => "Mechanical engineer"],
            ['name' => "Media buyer"],
            ['name' => "Media planner"],
            ['name' => "Media researcher"],
            ['name' => "Mediator"],
            ['name' => "Medical illustrator"],
            ['name' => "Medical sales representative"],
            ['name' => "Medical science liaison"],
            ['name' => "Medicinal chemist"],
            ['name' => "Mental health nurse"],
            ['name' => "Merchant Navy officer"],
            ['name' => "Metallurgist"],
            ['name' => "Meteorologist"],
            ['name' => "Microbiologist"],
            ['name' => "Midwife"],
            ['name' => "Minerals surveyor"],
            ['name' => "Mining engineer"],
            ['name' => "Mortgage adviser"],
            ['name' => "Mudlogger"],
            ['name' => "Multimedia programmer"],
            ['name' => "Multimedia specialist"],
            ['name' => "Museum education officer"],
            ['name' => "Museum & gallery curator"],
            ['name' => "Museum & gallery exhibitions officer"],
            ['name' => "Music producer"],
            ['name' => "Music therapist"],
            ['name' => "Musician"],
            ['name' => "Nanotechnologist"],
            ['name' => "Nature conservation officer"],
            ['name' => "Naturopath"],
            ['name' => "Naval architect"],
            ['name' => "Network engineer"],
            ['name' => "Neurologist"],
            ['name' => "Neuroscientist"],
            ['name' => "Newspaper journalist"],
            ['name' => "Nuclear engineer"],
            ['name' => "Nutritional therapist"],
            ['name' => "Nutritionist"],
            ['name' => "Occupational hygienist"],
            ['name' => "Occupational psychologist"],
            ['name' => "Occupational therapist"],
            ['name' => "Oceanographer"],
            ['name' => "Office manager"],
            ['name' => "Operational investment banker"],
            ['name' => "Operational researcher"],
            ['name' => "Ophthalmologist"],
            ['name' => "Optometrist"],
            ['name' => "Orthoptist"],
            ['name' => "Osteopath"],
            ['name' => "Outdoor activities manager"],
            ['name' => "Paralegal"],
            ['name' => "Paramedic"],
            ['name' => "Passenger transport manager"],
            ['name' => "Patent attorney"],
            ['name' => "Patent examiner"],
            ['name' => "Pathologist"],
            ['name' => "Pathology technologist"],
            ['name' => "Penetration tester"],
            ['name' => "Pension scheme manager"],
            ['name' => "Pensions consultant"],
            ['name' => "Personal assistant"],
            ['name' => "Personal trainer"],
            ['name' => "Petroleum engineer"],
            ['name' => "Pharmacologist"],
            ['name' => "Photographer"],
            ['name' => "Physician associate"],
            ['name' => "Physiotherapist"],
            ['name' => "Planning and development surveyor"],
            ['name' => "Plant breeder/geneticist"],
            ['name' => "Play therapist"],
            ['name' => "Podiatrist"],
            ['name' => "Police officer"],
            ['name' => "Political risk analyst"],
            ['name' => "Politician's assistant"],
            ['name' => "PPC specialist"],
            ['name' => "Press photographer"],
            ['name' => "Press sub-editor"],
            ['name' => "Primary school teacher"],
            ['name' => "Print production planner"],
            ['name' => "Printmaker"],
            ['name' => "Prison officer"],
            ['name' => "Private music teacher"],
            ['name' => "Private tutor"],
            ['name' => "Probation officer"],
            ['name' => "Product designer"],
            ['name' => "Product manager"],
            ['name' => "Process development scientist"],
            ['name' => "Production designer"],
            ['name' => "Theatre, television, film"],
            ['name' => "Production manager"],
            ['name' => "Project manager"],
            ['name' => "Prosthetist & orthotist"],
            ['name' => "Psychiatrist"],
            ['name' => "Psychological wellbeing practitioner"],
            ['name' => "Psychotherapist"],
            ['name' => "Public affairs consultant"],
            ['name' => "Public house manager"],
            ['name' => "Public librarian"],
            ['name' => "Public relations account executive"],
            ['name' => "Public relations officer"],
            ['name' => "Publishing copy-editor"],
            ['name' => "Publishing rights manager"],
            ['name' => "Purchasing manager"],
            ['name' => "Quality manager"],
            ['name' => "Quantity surveyor"],
            ['name' => "Quarry manager"],
            ['name' => "Radiation protection practitioner"],
            ['name' => "Radio broadcast assistant"],
            ['name' => "Radio producer"],
            ['name' => "Records manager"],
            ['name' => "Recruitment consultant"],
            ['name' => "Recycling officer"],
            ['name' => "Regulatory affairs officer"],
            ['name' => "Research scientist (life sciences)"],
            ['name' => "Research scientist (maths)"],
            ['name' => "Research scientist (medical)"],
            ['name' => "Research scientist (physical sciences)"],
            ['name' => "Restaurant manager"],
            ['name' => "Retail banker"],
            ['name' => "Retail buyer"],
            ['name' => "Retail manager"],
            ['name' => "Retail merchandiser"],
            ['name' => "Risk manager"],
            ['name' => "Rural practice surveyor"],
            ['name' => "Sales executive"],
            ['name' => "Sales promotion account executive"],
            ['name' => "Science writer"],
            ['name' => "Scientific laboratory technician"],
            ['name' => "Secondary school teacher"],
            ['name' => "Secretary"],
            ['name' => "Senior tax professional"],
            ['name' => "SEO specialist"],
            ['name' => "Site engineer"],
            ['name' => "Social media manager"],
            ['name' => "Social researcher"],
            ['name' => "Social worker"],
            ['name' => "Software engineer"],
            ['name' => "Software tester"],
            ['name' => "Soil scientist"],
            ['name' => "Solicitor"],
            ['name' => "Sound engineer"],
            ['name' => "Sound technician"],
            ['name' => "Special educational needs coordinator"],
            ['name' => "Special educational needs teacher"],
            ['name' => "Special effects technician"],
            ['name' => "Speech and language therapist"],
            ['name' => "Sport and exercise psychologist"],
            ['name' => "Sports administrator"],
            ['name' => "Sports coach"],
            ['name' => "Sports development officer"],
            ['name' => "Sports therapist"],
            ['name' => "Statistician"],
            ['name' => "Stockbroker"],
            ['name' => "Structural engineer"],
            ['name' => "Stylist"],
            ['name' => "Supply chain manager"],
            ['name' => "Surgeon"],
            ['name' => "Sustainability consultant"],
            ['name' => "Systems analyst"],
            ['name' => "Talent agent"],
            ['name' => "Tax adviser"],
            ['name' => "Teaching assistant"],
            ['name' => "Teaching laboratory technician"],
            ['name' => "Technical author"],
            ['name' => "Technical brewer"],
            ['name' => "Technical sales engineer"],
            ['name' => "Telecommunications researcher"],
            ['name' => "Television camera operator"],
            ['name' => "Television floor manager"],
            ['name' => "Television production coordinator"],
            ['name' => "Television, film,video producer"],
            ['name' => "Textile designer"],
            ['name' => "Theatre director"],
            ['name' => "Theatre manager"],
            ['name' => "Theatre stage manager"],
            ['name' => "Theme park manager"],
            ['name' => "Therapeutic radiographer"],
            ['name' => "Tour manager"],
            ['name' => "Tourism officer"],
            ['name' => "Tourist information centre manager"],
            ['name' => "Town planner"],
            ['name' => "Toxicologist"],
            ['name' => "Trade mark attorney"],
            ['name' => "Trade union research officer"],
            ['name' => "Trading standards officer"],
            ['name' => "Training and development officer"],
            ['name' => "Translator"],
            ['name' => "Transport planner"],
            ['name' => "Travel agency manager"],
            ['name' => "Urban designer"],
            ['name' => "UX designer"],
            ['name' => "UX researcher"],
            ['name' => "Veterinary nurse"],
            ['name' => "Veterinary surgeon"],
            ['name' => "VFX artist"],
            ['name' => "Visual merchandiser"],
            ['name' => "Volunteer coordinator"],
            ['name' => "Warehouse manager"],
            ['name' => "Waste management officer"],
            ['name' => "Water engineer"],
            ['name' => "Water quality scientist"],
            ['name' => "Web content manager"],
            ['name' => "Web designer"],
            ['name' => "Web developer"],
            ['name' => "Wellsite geologist"],
            ['name' => "Writer"],
            ['name' => "Youth worker"],
            ['name' => "Zookeeper"],
            ['name' => "Zoologist"],
        ];
        DB::table('occupations')->insert($occupations);
    }
}
