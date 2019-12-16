- Q1: Which architecture do you think is the best, Monolithic or Microservices Architecture? Why?
- A1: Microservices Architecture. Scalable, mostly resistent from failure cascade, resilient.
---
- Q2: This question related with backend, Which languages are better, low level language or high-level language? Why?
- A2: High-level language. It is highly used (each language has many communities), and it is easier to maintain.
---
- Q3: If you are the architect of this platform, what is the tech stack you will use related with the short and long term of Giftano? Why?
- A3: For short term, since giftano is web based, PHP is ok. But we must develop it with microservices in mind. We can separate the product into smaller module, and review which module can be writed in other language, e.g: big data processing in phyton, store log in no-sql, etc. Those also applies to new features development.
---
- Q4: Could you please make a high-level design how the techstack will work (from developer local host to production server)? You may draw a diagram to make it easier for you to explain
- A4:  
Devs develop in his own local environment (recommended to use container / docker), each dev are commit their work in different git branches. They will then create pull request to develop branch and ask code review from other dev. And don't forget unittest. Develop branch can be deployed to staging server for QA / PM to test. Those process (run unittest + deployment) can be automated using CI/CD concept, QA also can create automated test based on use case.  
After QA / PM approve the work on develop, tech lead can merge the commits into master branch. Master branch then can be deployed to production server. The deployment process also can be automated using CI/CD concept.  
Each environment (local, staging, production) must be independent each. Means that each environment will have each database server, cache, queue, etc unrelated to other environment.
---
- Q5: To start rebuilding gift platform, how many people is needed and what’s the composition? 
- A5: 2 PM, 2 UI/UX Designer, 1 Tech Lead / Engineer Manager, 4 Backend, 3 Frontend, 3 QA. The numbers are minimum.
