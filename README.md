# gantt_vacation


Simple wrapper site to keep track of who is on vacation, and show it in a gantt graph.

Uses http://taitems.github.io/jQuery.Gantt/ for most of the work, and stores the dates in a SQLite database.

## Installation :
```
git clone https://github.com/jvhaarst/gantt_vacation.git vacation
cd vacation
git clone https://github.com/taitems/jQuery.Gantt.git
```

If you are using a stock Ubuntu installation with Apache, then also install the necessary packages like this:
```
sudo aptitude install php5-sqlite sqlite3
```
Then point your browser to the directory.

If you want to keep old data, just copy that over to the database directory.

