# openCX-CounterCode Development Report

Welcome to the documentation pages of the C.Alfred of **openCX**!

You can find here detailed about the C.Alfred, hereby mentioned as module, from a high-level vision to low-level implementation decisions, a kind of Software Development Report, organized by discipline ESOF: 

* Business modeling 
  * [Product Vision](#Product-Vision)
  * [Elevator Pitch](#Elevator-Pitch)
* Requirements
  * [Use Case Diagram](#Use-case-diagram)
  * [User stories](#User-stories)
  * [Domain model](#Domain-model)
* Architecture and Design
  * [Logical architecture](#Logical-architecture)
  * [Physical architecture](#Physical-architecture)
  * [Prototype](#Prototype)
* [Implementation](#Implementation)
* [Configuration and change management](#Configuration-and-change-management)
* [Project management](#Project-management)

---

## Product Vision

An important piece of data for a conference is knowing the attendance and time spent in any given talk.
This information benefits everyone involved, be it organizers, speakers or attendees through data collection.
Using two motion sensors on each door, lecture attendance data can be collected with acceptable precision. For each person that walks through the door, the motion sensors can determine wether they are entering or leaving the room giving us a rough estimate of how many people are in the room at each given time. This way, all the conference atendees can see how full is the lecture they are interested in before they decide if it's worthy to go. 


---
## Elevator Pitch
Have you ever rushed to a lecture just to find out there are no more seats available? Wouldn't be great to know that information beforehand? Not only will C.Alfred provide the number of seats available in real time but also access where the lecture is being held, its schedule, the speaker history, including feedback from his previous talks and so much more!

---
## Requirements

[Non-functional]
Document changes in conference space occupancy and process them into useful metric for all participants.

[Functional]
Distance measuring sensor unit (Sharp 2Y0A21 F 19)
Raspberry PI B 3+

Sensor unit outputs a voltage based on detection distance. This voltage change is processed by the raspberry pi and is correlated to a person entering the conference space.

### Use case diagram 


![Use Case Diagram](Diagram.png)

**Check room attendance**

Actor: User, Speaker and Organizer

Description: Providing information relative to the number of people that are attending or attended a lecture.

Preconditions and Postconditions: Search for the lecture you are interested in the website.

Normal Flow: 	
  1. Check the room attendance
  2. Head to the room displayed on the website.
  3. Find yourself a seat and enjoy the lecture.

Alternative Flows and Exceptions:
  1. Check the room attendance.
  2. If the room is full, search for another lecture that isn’t.
  
 
**Get previous conference or speaker analytics**

Actor: User and Organizer

Description: Providing information relative to a conference or speaker.

Preconditions and Postconditions: Search for the speaker or the conference you are interested in the website.

Normal Flow: 	
  1. Check the feedback.

Alternative Flows and Exceptions: There are none.


**Check previous lectures statistics**

Actor: Speaker

Description: Providing feedback relative to a talk held by the speaker.

Preconditions and Postconditions: Search for the lecture you are interested in the website.

Normal Flow:
  1. Check the feedback.

Alternative Flows and Exceptions: There are none.


**Analyse conference interest**

Actor: Organizer

Description: Providing information relative to the number of people that are attending or attended a lecture and their feedback.

Preconditions and Postconditions: In order to check the room attendance, the lecture must started or ended. The overall feedback is only available after people posted their opinion. Then the organizer needs to search for the lecture in the website.

Normal Flow: 	
  1. Check the room attendance.
  2. Check the attendees feedback regarding the conference.

Alternative Flows and Exceptions:
  1. Check the attendees feedback regarding the conference.
  2. Check the room attendance.
  

**Check lecture location**

Actor: User and Speaker

Description: Providing information relative to where the lecture will take place.

Preconditions and Postconditions: Search for the lecture you are interested in the website.

Normal Flow: 	
  1. Check the room where the lecture is being held.

Alternative Flows and Exceptions: There are none.


**Provide feedback about the lecture and its preparation**

Actor: Speaker

Description: Providing feedback relative to the preparation thelectures itself the Speaker participated in.

Preconditions and Postconditions: The lectures must have ended already and the Speaker needs to be able to access the Internet and search for the lecture in the website.

Normal Flow: 	
  1. Write your opinion regarding the lecture and its preparation.

Alternative Flows and Exceptions: There are none.


**Estimate a certain speaker’s popularity**

Actor: Organizer

Description: Give a “rating” to each speaker based on his reviews on other conferences.
Preconditions and Postconditions: The Speaker must have had at least one talk in other conference and must have at least one review. Also he needs to access the website and search for the speaker in question.

Normal Flow: 	
  1. Check its popularity.

Alternative Flows and Exceptions: There are none.





### User stories

[User Stories](https://trello.com/b/TEjaBTpK/user-stories)

### Domain model

![UML Diagram](DomainModel.png)

---

## Architecture and Design

Sensor connected to RaspberryPi running python
Web server running website and database
Website: information displayed and some features: feedback form, add a talk, check room attendance, register speakers accounts.
RaspberryPi: Processes entrances and sends the information to the webserver.

   In order to calculate the room attendance, a RaspberryPi running a python script is used to determine if a person entered or left the room using two distance measuring sensors and the sequence by which they are triggered.
   As a way of adding the entries and exits of the several lectures, the RaspberryPi sends a HTTP request to the server and inserts the formated data into the database.
   The database provides the information needed for display in the website.
   With all this data available in the website, every atendee, speaker or organizer can check it with their phone.


### Logical architecture
![UML Logical](logicalDiag.png)
### Physical architecture
![UML Physical](physical.png)
### Prototype
---
  Check the room attendance was the user story chosen to demonstrate in the prototype. Every person that enters or leaves the room, where the selected lecture is being held, will trigger the distance measuring sensors.
  The sequence which the sensors are activated will be processed by the RaspberryPi, running a python script.
  The RaspberryPi makes an HTTP request to add the newly collected data to the database in the server. 
  The website then displays the information by quering the database.
  Any user, speaker or organiser can, at any given time, check the website for this information.


## Implementation
---
  The two distance measuring sensors capture data at the door. A python script, running in the RaspberryPi, is pooling data from those sensors. The state of the sensors is processed by a logical state macine to determine if a person is entering or leaving the room. Afterwards, a request is made to insert that piece of data into the database, to be displayed in the website.



## Configuration and change management

   The python script responsible for counting the entries and exits of an existing room was developed in the master branch from the beginning. At this stage, the data was being inserted locally into the database. At certain point, it was also included a first version of the website.
   Then, a branch was created to focus on the conclusion of the website. Diferente logins (organizer and speaker), attendance and rating charts and the possibility to add speakers and talks were added. The database was stored with the website and a REST API was made so the python script could make HTTP requests to read and insert data.
   The branch was merged and a few small fixes were made before the project delivery.

---

## Project management

  * [Trello.com](https://trello.com/b/TEjaBTpK/c-alfred)

