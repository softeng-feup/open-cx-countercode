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
* [Test](#Test)
* [Configuration and change management](#Configuration-and-change-management)
* [Project management](#Project-management)

So far, contributions are exclusively made by the initial team, but we hope to open them to the community, in all areas and topics: requirements, technologies, development, experimentation, testing, etc.

Please contact us! 

Thank you!

*team members names*

---

## Product Vision

An important piece of data for a conference is knowing the attendance and time spent in any given talk.
This information benefits everyone involved, be it organizers, speakers or attendees through data collection.
Using two motion sensors on each door, lecture attendance data can be collected with acceptable precision. For each person that walks through the door, the motion sensors can determine wether they are entering or leaving the room giving us a rough estimate of how many people are in the room at each given time.


---
## Elevator Pitch
Have you ever rushed to a lecture just to find out there are no more seats available? Wouldn't be great to know that information beforehand? Not only will C.Alfred provide the number of seats available in real time but also access where the lecture is being held, its schedule, the speaker history, including feedback from his previous talks and so much more!

---
## Requirements

Non functional:
  First Iteration:
    IR camera and reflective dots - Regarding this method, we are looking to get a precise count of seats that maybe occupied or whose dot is obstructed. 
  Second Iteration: 
    Arduino camera - With an Arduino camera we intend to scan the room for faces in order to get a count of seats that are occupied, with this method we are limited by camera resolution.

### Use case diagram 


![GitHub Logo](Diagram.png)

**Check room attendance**

Actor: User, Speaker and Organizer

Description: Providing information relative to the number of people that are attending or attended a lecture.

Preconditions and Postconditions: Carry a portable device with access to the Internet.

Normal Flow: 	
  1. Access the website.
  2. Search for the lecture you are interested in.
  3. Check the room attendance
  4. Head to the room displayed on the website.
  5. Find yourself a seat and enjoy the lecture.

Alternative Flows and Exceptions:
	 1. Access the website.
		2. Search for the lecture you are interested in.
		3. Check the room attendance.
		4. If the room is full, search for another lecture that isn’t.
  
 
**Get previous conference or speaker analytics**

Actor: User and Organizer

Description: Providing information relative to a conference or speaker.

Preconditions and Postconditions: Carry a portable device with access to the Internet.

Normal Flow: 	
  1. Access the website.
		2. Search for the speaker and conference you are interested in.
		3. Check the feedback.

Alternative Flows and Exceptions: There are none.


**Check previous lectures statistics**

Actor: Speaker

Description: Providing feedback relative to a talk held by the speaker.

Preconditions and Postconditions: Carry a portable device with access to the Internet.

Normal Flow: 	
  1. Access the website.
		2. Search for the lectures in which you will talk.
		3. Check the feedback.

Alternative Flows and Exceptions: There are none.


**Analyse conference interest**

Actor: Organizer

Description: Providing information relative to the number of people that are attending or attended a lecture and their feedback.

Preconditions and Postconditions: In order to check the room attendance, the lecture must started or ended. The overall feedback is only available after people posted their opinion. Also the organizer needs to be able to access the internet.

Normal Flow: 	
  1. Access the website.
  2. Search for the lecture you are interested in.
  3. Check the room attendance.
  4. Check the attendees feedback regarding the conference.

Alternative Flows and Exceptions:
  1. Access the website.
  2. Search for the lecture you are interested in.
  3. Check the attendees feedback regarding the conference.
  4. Check the room attendance.
  

**Check lecture location**

Actor: User and Speaker

Description: Providing information relative to where the lecture will take place.

Preconditions and Postconditions: Carry a portable device with access to the Internet.

Normal Flow: 	
  1. Access the website.
		2. Search for the lecture you are interested in.
		3. Check the room where the lecture is being held.

Alternative Flows and Exceptions: There are none.


**Provide feedback about the lecture and its preparation**

Actor: Speaker

Description: Providing feedback relative to the preparation thelectures itself the Speaker participated in.

Preconditions and Postconditions: The lectures must have ended already and the Speaker needs to be able to access the Internet.

Normal Flow: 	
  1. Access the website.
		2. Search for the lecture you participated in.
		3. Write your opinion regarding the lecture and its preparation.

Alternative Flows and Exceptions: There are none.


**Estimate a certain speaker’s popularity**

Actor: Organizer

Description: Give a “rating” to each speaker based on his reviews on other conferences.
Preconditions and Postconditions: The Speaker must have had at least one talk in other conference and must have at least one review.

Normal Flow: 	
  1. Access the website.
		2. Search for the speaker you are interested in.
		3. Check its popularity.

Alternative Flows and Exceptions: There are none.





### User stories
This section will contain the requirements of the product described as **user stories**, organized in a global **user story map** with **user roles** or **themes**.

For each theme, or role, you may add a small description. User stories should be detailed in the tool you decided to use for project management (e.g. trello or github projects).

A user story is a description of desired functionality told from the perspective of the user or customer. A starting template for the description of a user story is 

*As a < user role >, I want < goal > so that < reason >.*


**INVEST in good user stories**. 
You may add more details after, but the shorter and complete, the better. In order to decide if the user story is good, please follow the [INVEST guidelines](https://xp123.com/articles/invest-in-good-stories-and-smart-tasks/).

**User interface mockups**.
After the user story text, you should add a draft of the corresponding user interfaces, a simple mockup or draft, if applicable.

**Acceptance tests**.
For each user story you should write also the acceptance tests (textually in Gherkin), i.e., a description of scenarios (situations) that will help to confirm that the system satisfies the requirements addressed by the user story.

**Value and effort**.
At the end, it is good to add a rough indication of the value of the user story to the customers (e.g. [MoSCoW](https://en.wikipedia.org/wiki/MoSCoW_method) method) and the team should add an estimation of the effort to implement it, for example, using t-shirt sizes (XS, S, M, L, XL).

### Domain model

To better understand the context of the software system, it is very useful to have a simple UML class diagram with all the key concepts (names, attributes) and relationships involved of the problem domain addressed by your module.

---

## Architecture and Design
The architecture of a software system encompasses the set of key decisions about its overall organization. 

A well written architecture document is brief but reduces the amount of time it takes new programmers to a project to understand the code to feel able to make modifications and enhancements.

To document the architecture requires describing the decomposition of the system in their parts (high-level components) and the key behaviors and collaborations between them. 

In this section you should start by briefly describing the overall components of the project and their interrelations. You should also describe how you solved typical problems you may have encountered, pointing to well-known architectural and design patterns, if applicable.

### Logical architecture
The purpose of this subsection is to document the high-level logical structure of the code, using a UML diagram with logical packages, without the worry of allocating to components, processes or machines.

It can be beneficial to present the system both in a horizontal or vertical decomposition:
* horizontal decomposition may define layers and implementation concepts, such as the user interface, business logic and concepts; 
* vertical decomposition can define a hierarchy of subsystems that cover all layers of implementation.

### Physical architecture
The goal of this subsection is to document the high-level physical structure of the software system (machines, connections, software components installed, and their dependencies) using UML deployment diagrams or component diagrams (separate or integrated), showing the physical structure of the system.

It should describe also the technologies considered and justify the selections made. Examples of technologies relevant for openCX are, for example, frameworks for mobile applications (Flutter vs ReactNative vs ...), languages to program with microbit, and communication with things (beacons, sensors, etc.).

### Prototype
To help on validating all the architectural, design and technological decisions made, we usually implement a vertical prototype, a thin vertical slice of the system.

In this subsection please describe in more detail which, and how, user(s) story(ies) were implemented.

---

## Implementation
During implementation, while not necessary, it 

It might be also useful to explain a few aspects of the code that have the greatest potential to confuse software engineers about how it works. 

Since the code should speak by itself, try to keep this section as short and simple as possible.

Use cross-links to the code repository and only embed real fragments of code when strictly needed, since they tend to become outdated very soon.

---
## Test

There are several ways of documenting testing activities, and quality assurance in general, being the most common: a strategy, a plan, test case specifications, and test checklists.

In this section it is only expected to include the following:
* test plan describing the list of features to be tested and the testing methods and tools;
* test case specifications to verify the functionalities, using unit tests and acceptance tests.
 
A good practice is to simplify this, avoiding repetitions, and automating the testing actions as much as possible.

---
## Configuration and change management

Configuration and change management are key activities to control change to, and maintain the integrity of, a project’s artifacts (code, models, documents).

For the purpose of ESOF, we will use a very simple approach, just to manage feature requests, bug fixes, and improvements, using GitHub issues and following the [GitHub flow](https://guides.github.com/introduction/flow/).


---

## Project management

Software project management is an art and science of planning and leading software projects, in which software projects are planned, implemented, monitored and controlled.

In the context of ESOF, we expect that each team adopts a project management tool capable of registering tasks, assign tasks to people, add estimations to tasks, monitor tasks progress, and therefore being able to track their projects.

Example of tools to do this are:
  * [Trello.com](https://trello.com)
  * [Github Projects](https://github.com/features/project-management/com)
  * [Pivotal Tracker](https://www.pivotaltracker.com)
  * [Jira](https://www.atlassian.com/software/jira)

We recommend to use the simplest tool that can possibly work for the team.
