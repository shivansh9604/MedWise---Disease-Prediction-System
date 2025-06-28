import pandas as pd
import numpy as np
import pickle
from imblearn.over_sampling import SMOTE
from sklearn.model_selection import train_test_split, GridSearchCV
from sklearn.preprocessing import StandardScaler
from sklearn.ensemble import RandomForestClassifier
from xgboost import XGBClassifier
from sklearn.metrics import accuracy_score

# Load dataset
df = pd.read_csv("diabetes.csv")  

# Split into features (X) and target (y)
X = df.drop(columns=["Outcome"])  # ✅ Use only 8 features
y = df["Outcome"]                 # ✅ Target variable

# Handle class imbalance
smote = SMOTE(random_state=42)
X_resampled, y_resampled = smote.fit_resample(X, y)

# Split into training & test sets
X_train, X_test, y_train, y_test = train_test_split(X_resampled, y_resampled, test_size=0.2, random_state=42)

# Standardize features
scaler = StandardScaler()
X_train_scaled = scaler.fit_transform(X_train)
X_test_scaled = scaler.transform(X_test)

# Train model with hyperparameter tuning
model = XGBClassifier(n_estimators=200, max_depth=4, learning_rate=0.1, random_state=42)
model.fit(X_train_scaled, y_train)

# Evaluate model accuracy
y_pred = model.predict(X_test_scaled)
accuracy = accuracy_score(y_test, y_pred)
print(f"🚀 Model Accuracy: {accuracy:.4f}")  # ✅ Improved accuracy

# Save the trained model and scaler
pickle.dump(model, open("model.pkl", "wb"))
pickle.dump(scaler, open("scaler.pkl", "wb"))

print("✅ Model and scaler saved successfully!")
