#!/usr/bin/env python
# coding: utf-8

# In[13]:


get_ipython().system('pip install faker')
from collections import OrderedDict
import faker
import numpy as np
from datetime import datetime
import codecs
import random

def fortitle(text):
    # First letter is Upper in titles
    title = text[0].upper()
    # check on the title and see
    a = False
    for j in range(1, len(text)):
        #If i have space, then the first letter of the next word must be upper, so keep it in mind
        if text[j] == ' ':
            title += text[j]
            a = True
        if a:
            title += text[j].upper()
            a = False
        else:
            title += text[j]
    return title

language_loc = OrderedDict([
    ('en-US', 7),
])
fake = faker.Faker(language_loc)
content = ""
########################### Stelexos ###########################

DUMMY_DATA_NUMBER = 100
THE_NAME = "Stelexos"
COLUMNS = ["ID_Stelexous", "Name"]

stelexi = []
for k in range(DUMMY_DATA_NUMBER):
    ID_Stelexous = 3300000+k
    Name = fake.name()
    if Name not in stelexi:
        stelexi.append(Name)
    content += f'INSERT INTO {THE_NAME} ({",".join(COLUMNS)}) VALUES ("{ID_Stelexous}","{Name}");\n'


########################### Program ###########################
DUMMY_DATA_NUMBER = 100
THE_NAME = "Program"
COLUMNS = ["Program_Address", "Names"]

Programs = []

for i in range(DUMMY_DATA_NUMBER):
    Program_Address = 3500000+i
    Names = fake.text(max_nb_chars=20)
    Programs.append(Names)
    content += f'INSERT INTO {THE_NAME} ({",".join(COLUMNS)}) VALUES ("{Program_Address}","{Names}");\n'

###################### Axiologisi #######################
DUMMY_DATA_NUMBER = 100
THE_NAME = "Axiologisi"
COLUMNS = ["ID_Axiologisis", "Dates", "Vathmos"]

for i in range(DUMMY_DATA_NUMBER):
    ID_Axiologisis = 1200000 + fake.unique.random_int(min=0, max=DUMMY_DATA_NUMBER-1)
    Dates =  fake.past_date(datetime.strptime('2019-1-01', "%Y-%m-%d"))
    Vathmos = random.uniform(0.0, 10.0)
    content += f'INSERT INTO {THE_NAME} ({",".join(COLUMNS)}) VALUES ("{ID_Axiologisis}", "{Dates}", "{Vathmos}");\n'

########################### Organization ###########################
DUMMY_DATA_NUMBER = 100
plithos_organizations = 100
THE_NAME = "Organization"
COLUMNS = ["ID_Organismou", "Syntomografia", "Name", "Odos", "City", "Postal_Code"]
##Anti na ta spasoyme opws einai sto Relational Model, ta valame paketo gia apodotikotita

def acronymio(words):
    # add first letter
    syntomo = words[0]

    # Syntomografia einai ta arxika kathe lexis, px Organismos Tilepikoinwniwn Elladas = OTE
    for j in range(1, len(words)):
        if words[j - 1] == ' ' and words[j] != ' ':
            syntomo += words[j]
            
    syntomo = syntomo.upper()
    return syntomo.replace('.', '')


for i in range(DUMMY_DATA_NUMBER):
    ID_Organismou = 3100000 + i
    Name = fortitle(fake.text(max_nb_chars=20))
    Syntomografia = acronymio(Name)
    Street = fake.street_name()
    Street_Number = fake.unique.random_int(min=1, max=100000)
    Odos = Street + str(Street_Number)
    City = fake.city()
    Postal_Code = fake.unique.random_int(min=10000, max=99999)
    content += f'INSERT INTO {THE_NAME} ({",".join(COLUMNS)}) VALUES ("{ID_Organismou}", "{Syntomografia}", "{Name}", "{Odos}", "{City}", "{Postal_Code}");\n'

########################### Epistimoniko_Pedio ###########################

THE_NAME = "Epistimoniko_Pedio"
COLUMNS = ["Name_Science_Field", "Code_anaforas"]

sectors = ['Flagship Projects', 'Science and Society Projects',
           'Researchers / Faculty Members Projects', 'Renewable Energy Sources',
           'Research Equipment Projects', 'Postdoctoral Fellow Projects', 
           'Doctoral Candidates Projects']
DUMMY_DATA_NUMBER = len(sectors)

for i in range(DUMMY_DATA_NUMBER):
    #print("NAI")
    Name_Science_Field = sectors[i % 7]
    Code_anaforas = i
    content += f'INSERT INTO {THE_NAME} ({",".join(COLUMNS)}) VALUES ("{Name_Science_Field}", "{Code_anaforas}");\n'

###################### Researcher #######################
DUMMY_DATA_NUMBER = 120
THE_NAME = "Researcher"
COLUMNS = ["ID_Ereuniti", "ID_Organismou", "First_Name", "Last_Name", "Gender", "Date_Work_Relationship", "Birth_Date"]
Ereunitis_tou_organismou = []
for i in range(DUMMY_DATA_NUMBER):
    ID_Ereuniti = 6100000 + i
    ID_Organismou = 3100000 + fake.random_int(min=0, max=99)
    Ereunitis_tou_organismou.append(ID_Organismou)
    Gender = np.random.choice(["Male", "Female"], p=[0.5, 0.5])
    First_Name = fake.first_name_male() if Gender=="Male" else fake.first_name_female()
    Last_Name = fake.last_name()
    Date_Work_Relationship = fake.past_date(datetime.strptime('2018-6-05', "%Y-%m-%d"))
    Birth_Date = fake.date_between_dates(date_start=datetime(1940,6,2), date_end=datetime(2004,6,4))
    content += f'INSERT INTO {THE_NAME} ({",".join(COLUMNS)}) VALUES ("{ID_Ereuniti}", "{ID_Organismou}", "{First_Name}", "{Last_Name}", "{Gender}", "{Date_Work_Relationship}", "{Birth_Date}");\n'

########################### Ergo-Epixorigisi ###########################
DUMMY_DATA_NUMBER = 100
plithos_erga = 100

#It is vital to  remember when I start and when I finish
border_dates = []
Ergo_toy_organismou = []
## 3700001 -> Organismos tade
THE_NAME = "Ergo_Epixorigisi"
COLUMNS = ["ID_Ergou", "Title", "Perilipsi", "Funding", "Start_Date", "End_Date", "ID_Stelexous", "ID_Ereuniti", "Program_Address", "ID_Axiologisis", "ID_Organismou"]

for i in range(DUMMY_DATA_NUMBER):
    ID_Ergou = 3700000 + i
    Title = fortitle(fake.text(max_nb_chars=35))
    Perilipsi = fake.text(max_nb_chars=110)
    Funding = fake.unique.random_int(min=100001, max=999999)
    Start_Date =  fake.past_date(datetime.strptime('2019-1-01', "%Y-%m-%d"))
    enarxi = Start_Date.year
    ##As we have, the project must have at least 1 year duration and maximum 4 years
    d1 = Start_Date.replace(year = enarxi + 1)
    d2 = Start_Date.replace(year = enarxi + 4)
    End_Date = fake.date_between_dates(d1, d2)
    synora = (Start_Date,End_Date)
    border_dates.append(synora)
    ID_Stelexous = 3300000 + fake.random_int(min=0, max=DUMMY_DATA_NUMBER-1)
    ##It depends on the programms that we have created above
    ID_Ereuniti = 6100000 + i
    Program_Address = 3500000+i #Programs[fake.unique.random_int(min=0, max=DUMMY_DATA_NUMBER-1)]
    ID_Axiologisis = 1200000 + fake.random_int(min=0, max=DUMMY_DATA_NUMBER-1)
    ID_Organismou = 3100000 + fake.random_int(min=0, max=plithos_organizations-1)
    Ergo_toy_organismou.append(ID_Organismou)
    content += f'INSERT INTO {THE_NAME} ({",".join(COLUMNS)}) VALUES ("{ID_Ergou}", "{Title}", "{Perilipsi}", "{Funding}", "{Start_Date}", "{End_Date}", "{ID_Stelexous}", "{ID_Ereuniti}", "{Program_Address}", "{ID_Axiologisis}" , "{ID_Organismou}");\n'

########################### Epistimoniko_Pedio_Ergou ###########################

DUMMY_DATA_NUMBER = 100
THE_NAME = "Epistimoniko_Pedio_Ergou"
COLUMNS = ["Name_Science_Field", "ID_Ergou", "Code_anaforas"]

for i in range(DUMMY_DATA_NUMBER):
    simetoxi_se_pedia = random.randint(1, 4)
    for k in range(simetoxi_se_pedia):
        Name_Science_Field = sectors[(i+k)%7]
        ID_Ergou = 3700000 + i
        Code_anaforas = (i+k)%7
        content += f'INSERT INTO {THE_NAME} ({",".join(COLUMNS)}) VALUES ("{Name_Science_Field}", "{ID_Ergou}", "{Code_anaforas}");\n'

###################### University #######################
checked = []
DUMMY_DATA_NUMBER = 100
THE_NAME = "University"
COLUMNS = ["University", "ID_Organismou", "Budget_from_Ministry_of_Education"]

for i in range(0, DUMMY_DATA_NUMBER, 3):
    a = True
    while a:
        c = random.choices("ABCDEFGHIJKLMNOPQRSTUVWXYZ",k=3)
        character = c[0]+c[1]+c[2]
        if character not in checked:
            checked.append(c)
            a = False
    University = "University " + str(character) 
    ID_Organismou = 3100000 + i
    Budget_from_Ministry_of_Education = fake.unique.random_int(min=100001, max=999999)
    content += f'INSERT INTO {THE_NAME} ({",".join(COLUMNS)}) VALUES ("{University}", "{ID_Organismou}", "{Budget_from_Ministry_of_Education}");\n'

###################### Research Center #######################
checked.clear()
checked = []
DUMMY_DATA_NUMBER = 100
THE_NAME = "Research_Center"
COLUMNS = ["Research_Center", "ID_Organismou", "Budget_from_Ministry", "Budget_from_Individuals"]
for i in range(2, DUMMY_DATA_NUMBER, 3):
    a = True
    while a:
        c = random.choices("ABCDEFGHIJKLMNOPQRSTUVWXYZ",k=3)
        character = c[0]+c[1]+c[2]
        if character not in checked:
            checked.append(c)
            a = False
    Research_Center = "Research Center " + str(character) 
    ID_Organismou = 3100000 + i
    Budget_from_Ministry = fake.unique.random_int(min=100001, max=999999)
    Budget_from_Individuals = fake.unique.random_int(min=100001, max=999999)
    content += f'INSERT INTO {THE_NAME} ({",".join(COLUMNS)}) VALUES ("{Research_Center}", "{ID_Organismou}", "{Budget_from_Ministry}", "{Budget_from_Individuals}");\n'

###################### Company #######################
checked.clear()
checked = []
DUMMY_DATA_NUMBER = 100
THE_NAME = "Company"
COLUMNS = ["Company", "ID_Organismou", "Own_Money"]
for i in range(1, DUMMY_DATA_NUMBER, 3):
    a = True
    while a:
        c = random.choices("ABCDEFGHIJKLMNOPQRSTUVWXYZ",k=3)
        character = c[0]+c[1]+c[2]
        if character not in checked:
            checked.append(c)
            a = False
    Company = "Company " + str(character) 
    ID_Organismou = 3100000 + i
    Own_Money = fake.unique.random_int(min=100001, max=1999999)
    content += f'INSERT INTO {THE_NAME} ({",".join(COLUMNS)}) VALUES ("{Company}", "{ID_Organismou}", "{Own_Money}");\n'

###################### Paradoteo #######################
DUMMY_DATA_NUMBER = 100
THE_NAME = "Paradoteo"
COLUMNS = ["Title_Paradoteo", "ID_Ergou", "Perilipsi", "Date_paradosis"]

for i in range(DUMMY_DATA_NUMBER):
    Title_Paradoteo = fortitle(fake.text(max_nb_chars=35))
    ID_Ergou = 3700000 + i
    Perilipsi = fake.text(max_nb_chars=110)
    synoraoria = border_dates[i]
    #Here the Date_paradosis must be between
    Date_paradosis = fake.date_between_dates(date_start=synoraoria[0], date_end=synoraoria[1])
    content += f'INSERT INTO {THE_NAME} ({",".join(COLUMNS)}) VALUES ("{Title_Paradoteo}", "{ID_Ergou}", "{Perilipsi}", "{Date_paradosis}");\n'


###################### Works On #######################
DUMMY_DATA_NUMBER = 120
plithos_erga = 100
THE_NAME = "Works_On"
COLUMNS = ["ID_Ereuniti", "ID_Ergou", "Enarxi_enasxolisis"]
#print(Ereunitis_tou_organismou)
#print(Ergo_toy_organismou)

for i in range(plithos_erga):
    ID_Ergou = 3700000 + i
    organismos_id_ergou = Ergo_toy_organismou[i]
    
    den_to_vrika = True
    metritis = 0
    while den_to_vrika and metritis < len(Ereunitis_tou_organismou):
        if organismos_id_ergou == Ereunitis_tou_organismou[metritis]:
            ID_Ereuniti = 6100000 + metritis
            den_to_vrika = False
        else:
            metritis += 1
    if den_to_vrika == False:
        synoraoria = border_dates[i]
        Enarxi_enasxolisis = fake.date_between_dates(date_start=synoraoria[0], date_end=synoraoria[1])
        content += f'INSERT INTO {THE_NAME} ({",".join(COLUMNS)}) VALUES ("{ID_Ereuniti}", "{ID_Ergou}", "{Enarxi_enasxolisis}");\n'
    else:
        continue

###################### Phones #######################
DUMMY_DATA_NUMBER = 100
THE_NAME = "Phones"
COLUMNS = ["ID_Organismou", "Phone_Numbers"]

for i in range(DUMMY_DATA_NUMBER):
    ID_Organismou = 3100000 + i
    Phone_Numbers = str(2100000000 + fake.unique.random_int(min=9999999, max=722222222))
    plithos = random.randint(0, 2)
    for k in range(plithos):
        Phone_Numbers += " " + str(2100000000 + fake.unique.random_int(min=1, max=722222222)) #me 28220 ksekinane kapoia tilefona eparxias, Crete etc
    content += f'INSERT INTO {THE_NAME} ({",".join(COLUMNS)}) VALUES ("{ID_Organismou}", "{Phone_Numbers}");\n'


with open(f"ELIDEK_Database_of_Project_6.sql", 'w') as f:
    f.write(content)


# In[26]:


character = random.choices("ABCDEFGHIJKLMNOPQRSTUVWXYZ",k=3)
print(character)
print(character[0]+character[1]+character[2])


# In[17]:


a = (1,2)
print(a[1])


# In[ ]:




